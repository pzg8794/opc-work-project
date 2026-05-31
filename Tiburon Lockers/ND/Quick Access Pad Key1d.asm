;=============================================================================
;	Author: 	C. Hentschel
;	Company:	UplandCompany
;	Revision:	1.0
;	Date:		Aug 23 2010
;=============================================================================
;	Include Files:	p18f2420.inc	V1.3
;=============================================================================
;
;=============================================================================
;
;=============================================================================


		list p=18f4520		;list directive to define processor
		#include <p18f4520.inc>	;processor specific definitions

;=============================================================================
;
;=============================================================================
;
;	Fuse settings
;
;/*-----------------------------*/
;/*     source code status      */
;/*-----------------------------*/
;#define UDEV_CODE 1            ; 
;#define EMU_DBG 1              ; 
;#define ICD_DBG 1              ;


;/*-----------------------------*/
;/*   mpasm / processor setup   */
;/*-----------------------------*/

        CONFIG  OSC = HS, IESO = OFF            ; oscillator select,  osc switch enable
        CONFIG  BOREN = OFF, PWRT = OFF         ; brown-out reset,  power-up timer
        CONFIG  CCP2MX = PORTC                  ; ccp2 mux: enable (rc1)
        CONFIG  STVREN = ON, LVP = OFF          ; stack overflow reset,  low voltage icsp
        CONFIG  PBADEN = OFF                    ; config portb <4:0> pins as digital
        CONFIG  WDTPS = 2048 ;512                     ; watchdog postscaler (2048 * 4ms = 8.192s)
        CONFIG  EBTRB=OFF                       ; boot block table read protection;

    IFDEF ICD_DBG
        CONFIG  DEBUG=ON                                ; background debugger
        CONFIG  WDT=OFF                                 ; watchdog timer disabled
        CONFIG  CP0=OFF, CP1=OFF, CP2=OFF, CP3=OFF      ; code block protection
        CONFIG  CPB=OFF, CPD=OFF                        ; boot block and data eeprom protection
        CONFIG  WRT0=OFF, WRT1=OFF, WRT2=OFF, WRT3=OFF  ; write block protection
        CONFIG  WRTB=OFF, WRTC=OFF, WRTD=OFF            ; boot block and config reg write protection
        CONFIG  EBTR0=OFF, EBTR1=OFF, EBTR2=OFF, EBTR3=OFF  ; table read protection
    ELSE
        CONFIG  DEBUG=OFF
        CONFIG  WDT=ON
        CONFIG  CP0=ON, CP1=ON, CP2=ON, CP3=ON          ; code block protecti

;	when this protection is on the system does not write to the eeprom
;       CONFIG  CPB=ON, CPD=ON                          ; boot block and data eeprom protection
        CONFIG  CPB=OFF, CPD=OFF                          ; boot block and data eeprom protection

        CONFIG  WRT0=ON, WRT1=ON, WRT2=ON, WRT3=ON      ; write block protection
        CONFIG  WRTB=OFF, WRTC=OFF, WRTD=OFF            ; boot block and config reg write protection
        CONFIG  EBTR0=ON, EBTR1=ON, EBTR2=ON, EBTR3=ON  ; table read protection
    ENDIF

;----------------------------------------------------------------------------
;Bit Definitions - flags
;Constants
TxBufFull	EQU	0		;
TxBufEmpty	EQU	1		;
RxBufFull	EQU	2		;
RxBufEmpty	EQU	3		;
ReceivedCR	EQU	4		;bit indicates <CR> character received
StartPkt	EQU	5		; 
StartPkt2	EQU	6		; 
PktTimer	EQU	7		; 
SPBRG_VAL	EQU	.47		;set baud rate 9600 for 7.3728 Mhz clock

TX_BUF_LEN	EQU	.25			;
RX_BUF_LEN	EQU	TX_BUF_LEN	;
TxDly		EQU	0x08		;
;
;	firmware version
;
FW1		EQU	0x31		; 4		
FW2		EQU	0x41		; A
;
;	Command bytes
;
;----------------------------------------------------------------------------
;Bit Definitions - flags

TxBufFull	EQU	0		;
TxBufEmpty	EQU	1		;
RxBufFull	EQU	2		;
RxBufEmpty	EQU	3		;
ReceivedCR	EQU	4		;
StartPkt	EQU	5		; 
StartPkt2	EQU	6		;
PktTimer	EQU	7		; 

;Bit Definitions - errflag

eop_err	EQU	0		; end of packet bytes don't match
cs_err	EQU	1		; checksum error
un_cmd	EQU	2		; unknown command
;
;	values used for reset
;
kbtimeout	EQU	d'10'		; 
progtimeout	EQU	d'30'		; 
unlock_IT	EQU	d'05'		;
unlock_time	EQU	d'05'		;
P_card_dur	EQU	d'240'		;
set_venue_id	EQU	d'01'		;
;
;	EEPROM memory map
;

;
;----------------------------------------------------------------------------
;Variables

		CBLOCK	0x000
		begin_ram
		WREG_TEMP		;to save WREG during interrupt
		STATUS_TEMP		;to save STATUS during interrupt
		BSR_TEMP		;to save BSR during interrupt
		FSR0H_TEMP		;to save FSR0H during interrupt
		FSR0L_TEMP		;to save FSR0L during interrupt
		FSR0H_SHADOW	;to save FSR0H during high interrupt
		FSR0L_SHADOW	;to save FSR0L during high interrupt
						; b7 - broadcast address detected
		Flags			; used for uart
		toggle			; increments every .125 seconds
		tdly2			; used by 500uS delay routine
		temp1
		temp2
		temp3
		temp4
		t_beep
		r_temp			; used only in called routine
		sec_lo
		sec_hi
		last_pcard
		last_min
;
;		keypad scan registers
;
		KBrow1			; keypad row1 data
		KBrow2			; keypad row2 data
		KBrow3			; keypad row3 data
		lastdig
		kb_cmd			; last two digits entered after the # key is pressed	
		kb_cmd_H		; first two digit enters after the # key is pressed	
		kb_timer  		; keypress timer - regs cleared on timeout	
		unlock_tmr		; timer to signal unlock - flashing green led
		KBflags				; 
		KBflags2		
		RFflags		
		digit21			; keypress digit storagfe registers
		digit43			;
		digit65			; 
		digit87			; 
		digit09			; 
		digitBA			; 
		digitDC
		kbtemp
		sec_cnt			; seconds counter
		read_dly		; 
;
;	rtc registers
;	
		pre_sec			; counts .125 seconds
		secs
		mins
		hours
		t_hours			; temp hours register until min are verified during programming
		hoursL
		hoursH
		daysL
		daysH
		venue_id		
		card_read_timer	
		card_t0			
;
;  	EEprom read write registers
		EEadr
		EEdata	
		kbto			
		pto		
		u_it			
		un_t		
		ven_id			
;
		cdig21		
		cdig43		
		cdig65 		
;			
;
;	bcd conversion
;
		bin_result
		bin_resultU
		tempb
;
		Hbyte
		Lbyte
		R0
		R1
		R2
		Ltemp
		Htemp

;
;		end of keypad registers
;
;		start of data transfer register
		xfercnt
		dataout1
		dataout2
		dataout3
		dataout4
		dataout5
		dataout6
		dataout7
		dataout8


		datain1
		datain2
		datain3
		datain4
		datain5
		datain6
		datain7
		datain8

;
		begin_rc
		RCdata0			; data from card read
		RCdata1
		RCdata2
		RCdata3
		RCdata4
		RCdata5
		RCdata6
		RCdata7
		RCdata8
		RCdata9
		RCdataA
		RCdataB
		RCdataC
		RCdataD
		RCdataE
		RCdataF

		card_sn1			; card serial number
		card_sn2
		card_sn3
		card_sn4

		card_data1			
		card_data2
		card_data3
		card_data4
		card_data5			
		card_data6
		card_data7
		card_data8

		page_data1			; data to write to card
		page_data2
		page_data3
		page_data4

		rc_cnt
		rctemp
		last_cmd			; last command sent
		last_page			; location of last page read			
;
		TxBytes			
		txb_00			; transmit buffers
		txb_01
		txb_02
		txb_03
		txb_04
		txb_05
		txb_06
		txb_07
		txb_08

		ram_end

		ENDC

;----------------------------------------------------------------------------
;	PORT DEFINITIONS
;

;/*----------------------------*/
;/*        i/o mapping         */
;/*----------------------------*/
IOA	equ	B'11011111'	; porta

IOB	equ	B'11000000'	; portb

IOC	equ	B'10111000'	; portc

IOD	equ	B'00000110'	; portd

IOE	equ	B'00000000'	; porte

;This code executes when a reset occurs.

				ORG	0x0000		;place code at reset vector

ResetVector:			bra	Main		;go to beginning of program

;----------------------------------------------------------------------------
;This code executes when a high priority interrupt occurs.

				ORG	0x0008			
				bra	int_1
;
;----------------------------------------------------------------------------
;This code executes when a low priority interrupt occurs.

				ORG		0x0018
int_1
				movff		STATUS,STATUS_TEMP	;save STATUS register
				movff		WREG,WREG_TEMP		;save working register
				movff		BSR,BSR_TEMP		;save BSR register

				nop
				nop
				btfsc		PIR1,TMR1IF
				goto		rtc_handle
				btfss		PIE1,TXIE		; test if Tx interrupt is enabled
				bra		readuart
				btfss		PIR1,TXIF		; test for TXIF transmit interrupt flag
				bra		readuart		; if TXIF is not set, done with test

				btfss		Flags,TxBufEmpty 	; check if transmit buffer is empty flag set
				bra		PutDat1			; if not then go transmit
				bcf		PIE1,TXIE		; else disable Tx interrupt
				bra		intend
PutDat1				rcall		GetTxBuf
				movwf		TXREG			
				bra		intend
				
readuart			nop
				movf		RCREG,w
				movwf		POSTINC0
				decf		rc_cnt,f
				goto		intend

rtc_handle			nop
				movlw		0xF0			; set .125 second
				movwf		TMR1H	
				bcf		PIR1, TMR1IF		; clear interrupt
				incf		toggle,f

				btfss		KBflags,2		; check prgramming flag
				goto		pf_0
				bcf		LATD,6			
				btfsc		toggle,1
				bsf		LATD,6			
pf_0				nop

				btfss		KBflags,5	
				goto		pf_2
				bcf		LATD,4
				bcf		LATD,5		
				btfsc		toggle,1
				bsf		LATD,5			
pf_2				nop				
;
;
;
pf_ck				btfsc		KBflags,4
				goto		pf_1
				btfsc		KBflags,3	
				goto		pf_1
				goto		pf_end
pf_1				bsf		LATD,4		
				bcf		LATD,5
				btfss		toggle,2
				goto		pf_end
				bcf		LATD,4
				bsf		LATD,5	
pf_end				nop	

				movf		card_read_timer,f	
				btfsc		STATUS,Z
				goto		crt_end
				decf		card_read_timer,f
crt_end				nop			
						

rtc_h1				incf		pre_sec,f
				movlw		.07
				cpfsgt		pre_sec
				goto		intend
				clrf		pre_sec

				movf		unlock_tmr,f		
				btfsc		STATUS,Z
				goto		unlockt1
				decf		unlock_tmr,f
				btfsc		STATUS,Z
				bcf		KBflags,5		
unlockt1			nop

				movf		card_t0,f		
				btfsc		STATUS,Z
				goto		card_ta1
				decf		card_t0,f
card_ta1			nop

				movf		kb_timer,f		
				btfsc		STATUS,Z
				goto		unlock_end
				decf		kb_timer,f
				btfss		STATUS,Z
				goto		unlock_end
				clrf		digit21
				clrf		digit43
				clrf		digit65
				clrf		digit87
				clrf		digit09	
				clrf		digitBA	
				clrf		digitDC
				clrf		kb_cmd
				bcf		KBflags,2		
				bcf		LATD,6		
unlock_end			nop	

		
inc_sec				incf		secs,f
				movlw 		.59 		
				cpfsgt 		secs
				goto		intend 			
				clrf 		secs 		
				incf 		mins, F 			
				movlw		.59 			
				cpfsgt 		mins
				goto		intend 		
				clrf 		mins 		
				incf 		hours, F 	
				incf		hoursL,f
				btfsc		STATUS,C
				incf		hoursH
;
;	
				movf		hoursH,w
				movwf		EEDATA
				movlw		0x08
				call		EE_write
				movf		hoursL,w
				movwf		EEDATA
				movlw		0x09
				call		EE_write


				movlw 		.23 		
				cpfsgt 		hours
				goto		intend 		
				clrf 		hours 		
				incf		daysL,f
				btfsc		STATUS,C
				incf		daysH
				goto		intend			;


intend				nop
				movff		BSR_TEMP,BSR		;restore BSR register
				movff		WREG_TEMP,WREG		;restore working register
				movff		STATUS_TEMP,STATUS	;restore STATUS register
				retfie
;
;
;	Get data to send
;
GetTxBuf			nop
				movf		POSTINC1,w
				nop
				decfsz		TxBytes
				return
				bsf		Flags,TxBufEmpty
				nop
				return
;
; ------------------------------------------------------------------------------
;
;	timers
;
SUdly_L				movlw		0x02
SUdly_Lx			movwf		temp2		
				goto		SUlp1
;
SUdly				movlw		0xCD	
SUdlyx				movwf		temp1
				movlw		0x01
				movwf		temp2
SUlp1				call		dly2
				decfsz		temp1
				goto		SUlp1
				decfsz		temp2
				goto		SUlp1
				clrwdt
				return
;
;
ms_dly				movwf		temp1
				nop
ms_dly1				call		dly2
				call		dly2		; 1 ms delay
				decfsz		temp1
				goto		ms_dly1
				return				
;
;
;
dly2				movlw		0x81		
				movwf		tdly2
dly2a				nop
				nop
				nop
                      		nop

				decfsz		tdly2,f

				goto		dly2a
				return
;
;	sounder
;
beep				movlw		0x60
p_beep				movwf		t_beep	
				bsf		PORTE,2
				movwf		t_beep
				call		SUdlyx
				bcf		PORTE,2
				movwf		t_beep
				call		SUdlyx
				return
beep_error			movlw		0x03	
				movwf		temp3
errorL1				bsf		PORTE,2	
				movlw		0x0A
				call		SUdly_Lx
				bcf		PORTE,2
				call		SUdly_L
				decfsz		temp3
				goto		errorL1
				return

beep_ok				nop
				call		SUdly_L
				movlw		0x02		
				movwf		temp3
okL1				bsf		PORTE,2		
				movlw		d'50'
				call		ms_dly
				bcf		PORTE,2
				movlw		d'60'
				call		ms_dly
				decfsz		temp3
				goto		okL1
				return

;
;
;	
Read_status			movlw		0x01		
				movwf		TxBytes		
				movlw		0x53		
				movwf		txb_00
				movwf		last_cmd	
				goto		txbld_end
;
Read_id				movlw		0x02
				movwf		TxBytes		
				movlw		0x52		
				movwf		txb_00
				movwf		last_cmd
				movlw		0x00		
				movwf		txb_01
				movwf		last_page				
				goto		txbld_end
;
Read_page			movwf		txb_01			; save page number
				movwf		last_page
				movlw		0x02
				movwf		TxBytes
				movlw		0x52			
				movwf		txb_00
				movwf		last_cmd
				goto		txbld_end
;
Write_page			movwf		txb_01
				movlw		0x06		
				movwf		TxBytes
				movlw		0x57		
				movwf		txb_00
				movwf		last_cmd
				movf		page_data1,w	
				movwf		txb_02
				movf		page_data2,w
				movwf		txb_03
				movf		page_data3,w
				movwf		txb_04
				movf		page_data4,w
				movwf		txb_05
				goto		txbld_end
;			
txbld_end			nop
				lfsr		FSR1,txb_00		
				bcf		Flags,TxBufEmpty
				bsf		PIE1,TXIE		
				lfsr		FSR0,RCdata0		
				bcf		RCSTA,CREN	
				bsf		RCSTA,CREN	
				return
;			
Clr_RCdata			clrf		RCdata0
				clrf		RCdata1
				clrf		RCdata2
				clrf		RCdata3
				clrf		RCdata4
				clrf		RCdata5
				clrf		RCdata6
				clrf		RCdata7
				clrf		RCdata8
				clrf		RCdata9
				clrf		RCdataA
				clrf		RCdataB
				clrf		RCdataC
				clrf		RCdataD
				clrf		RCdataE
				clrf		RCdataF
				return				
;

;
Dataxfer			nop


				bcf		PORTD,0		
				btfsc		PORTD,1	
				return


				movlw		0x40
				movwf		xfercnt		
xfer2				bsf		PORTD,3	
				rrcf		dataout1
				rrcf		dataout2
				rrcf		dataout3
				rrcf		dataout4
				rrcf		dataout5
				rrcf		dataout6
				rrcf		dataout7
				rrcf		dataout8
				btfss		STATUS,C
				bcf		PORTD,3	
xfer0				btfss		PORTD,1	
				goto		xfer0	
				bcf		STATUS,C
				btfsc		PORTD,2	
				bsf		STATUS,C	
				rrcf		datain1
				rrcf		datain2
				rrcf		datain3
				rrcf		datain4
				rrcf		datain5
				rrcf		datain6
				rrcf		datain7
				rrcf		datain8
xfer1				btfsc		PORTD,1	
				goto		xfer1
				decfsz		xfercnt,f
				goto		xfer2
				bsf		PORTD,0		
				return
		
;
;
mpy10b
	andlw    	0x0f
	addwf     	Lbyte,F
	btfsc      	STATUS,C
	incf     	Hbyte,F
mpy10a
	bcf      	STATUS,C        ; multiply by 2
	rlcf     	Lbyte,W
	movwf     	Ltemp
	rlcf     	Hbyte,W        
	movwf    	Htemp
;
	bcf      	STATUS,C      
	rlcf     	Lbyte,F
	rlcf     	Hbyte,F
	bcf      	STATUS,C       
	rlcf     	Lbyte,F
	rlcf     	Hbyte,F
	bcf      	STATUS,C        ; multiply by 2
	rlcf     	Lbyte,F
	rlcf     	Hbyte,F      
;
	movf    	Ltemp,W
	addwf     	Lbyte,F
	movf    	Htemp,W
	addwfc    	Hbyte,F
	return                     	; (Hbyte,Lbyte) = 10*N
;
;	three bytes
;
BCDtoB
	clrf     	Hbyte
	movf    	digit65,W
	andlw    	0x0f
	movwf     	Lbyte
	call    	mpy10a          ; result = 10a+b
;
	swapf    	digit43,W
	call    	mpy10b          ; result = 10[10a+b]
;
	movf    	digit43,W
	call    	mpy10b         
;
	swapf    	digit21,W
	call    	mpy10b         
;
	movf    	digit21,W
	andlw    	0x0f
	addwf     	Lbyte,F
	btfsc      	STATUS,C
	incf     	Hbyte,F       	
	return          	       
;
; 	single byte
;				
BCD_byte	movwf		temp4
		clrf		Lbyte
		swapf    	temp4,W
		call    	mpy10b         
;
		movf    	temp4,W
		andlw    	0x0f
		addwf     	Lbyte,F
		return          	        
				
;
;
marker				bsf		PORTA,5		; marker
				call		dly2
				bcf		PORTA,5		; marker
				return
;
marker_t			movlw		b'00100000'
				xorwf		PORTA,f
				return
;				
;
B_red				movwf		r_temp
B_red1				bcf		PORTD,4
				bcf		PORTD,5		
				bsf		PORTD,4
				nop
				call		SUdly_L
				bcf		PORTD,4	
				call		SUdly_L
				decfsz		r_temp
				goto		B_red1 
				return				
B_grn				movwf		r_temp
B_grn1				bcf		PORTD,4
				bcf		PORTD,5
				bsf		PORTD,5	
				nop
				call		SUdly_L
				bsf		PORTD,4		
				call		SUdly_L
				decfsz		r_temp
				goto		B_grn1 
				return				
B_yel				movwf		r_temp
B_yel1				bsf		PORTD,6
				nop
				call		SUdly_L
				bcf		PORTD,6	
				call		SUdly_L
				decfsz		r_temp
				goto		B_yel1 
				return				
KPbeep				movlw		0x60
				movwf		t_beep	
				bsf		PORTE,2		
				bsf		PORTD,6	
				movwf		t_beep
				call		SUdlyx
				bcf		PORTE,2
				bcf		PORTD,6
				movwf		t_beep
				call		SUdlyx
				return
				
clr_digits			clrf		kb_cmd
clr_digitsc			clrf		digit21	
				clrf		digit43
				clrf		digit65
				clrf		digit87
				clrf		digit09	
				clrf		digitBA	
				clrf		digitDC
				return				

Main:				nop
				call		Initcode	; clear registers
;				bsf		KBflags,3	; set power failed bit clock
;				bsf		KBflags,4	; hours counter
;
SetupSerial:			movlw		0xc0		
				iorwf		TRISC,F
				movlw		SPBRG_VAL	
				movwf		SPBRG
				movlw		0x24		
				movwf		TXSTA
				movlw		0x90	
				movwf		RCSTA
				bsf		Flags,TxBufEmpty
;
;
				movlw		b'00100000'	
				movwf		PIE1
				movlw		b'00000000'	
				movwf		IPR1
				bcf		RCON,IPEN	
				movlw		b'11000000'		
				movwf		INTCON
;
;	setup timer 1 as RTC for 1 second interrupt
;
				movlw 		80h 	
				movwf 		TMR1H 	
				clrf 		TMR1L
				movlw 		b'00001111' 
				movwf 		T1CON 	
				clrf 		secs 	
				clrf 		mins 		;
;				movlw 		.12
;				movwf 		hours
				bsf 		PIE1, TMR1IE 	
				bsf		PORTD,0	
				movlw		0x01
				movwf		daysL

		movlw		0x04
		movwf		temp4
su1		nop
		call		SUdly_L
		call		beep
		decfsz		temp4
		goto		su1
		nop
		movlw		D'200'		
		movwf		read_dly
		goto		MainLoopcf
;
;
kb_program	nop
		btfss		KBflags,1	
		return					
		btfsc		KBflags,2	
		goto		kb_prog1
		nop
		movlw		0x99		
		cpfseq		kb_cmd
		goto		kb_prtn1
		movlw		0x12
		call		EE_read
		movf		EEDATA,w
		cpfseq		digit21
		goto		kb_prtn1		
		movlw		0x11
		call		EE_read
		movf		EEDATA,w
		cpfseq		digit43
		goto		kb_prtn1	
		movlw		0x10
		call		EE_read
		movf		EEDATA,w
		cpfseq		digit65
		goto		kb_prtn1
		bsf		KBflags,2		
		movlw		progtimeout
		movwf		kb_timer
		goto		cmd_good
		nop					
		nop
kb_prog1	btfsc		KBflags2,0
		goto		kb_ckcmd5v			
		nop				
		btfss		KBflags,1	
		goto		kb_ckcmd1
		movf		kb_cmd,f	
		btfss		STATUS,Z
		goto		kb_ckcmd1
		movf		digit21,w
		iorwf		digit43,w
		iorwf		digit65,w
		iorwf		digit87,w
		iorwf		digit09,w
		iorwf		digitBA,w
		iorwf		digitDC,w
		btfss		STATUS,Z
		goto		kb_ckcmd1
		bcf		KBflags,2		
		bcf		KBflags,1
		bcf		PORTD,6			
		return
kb_ckcmd1	nop					
		movlw		0x21
		cpfseq		kb_cmd
		goto		kb_ckcmd2
		movlw		0x01
		movwf		dataout5	

		clrf		digit65		
		movf		digit21,w
		call		BCDtoB
		movf		Hbyte,f
		btfss		STATUS,Z
		goto		cmd_error
		movf		Lbyte,w		
		nop
		movwf		dataout6			
		movf		un_t,w
		movwf		dataout7	

		bsf		KBflags,5	
		movlw		unlock_IT
		movwf		unlock_tmr

		bsf		dataout8,1	

		call		Dataxfer
		btfss		KBflags2,1
		goto		cmd_good
		bcf		KBflags2,1		
		bcf		KBflags,2		
		bcf		PORTD,6		
		goto		cmd_good
;		
kb_ckcmd2	movlw		0x33			
		cpfseq		kb_cmd
		goto		kb_ckcmd3
		movf		digit43,w
		call		BCD_byte
		nop
		movlw	 	d'24'
		cpfslt		Lbyte
		goto		cmd_error
		movf		Lbyte,w
		movwf		t_hours
		movf		digit21,w
		call		BCD_byte
		nop
		movlw		d'60'
		cpfslt		Lbyte
		goto		cmd_error
		movf		Lbyte,w
		movwf		mins
		movf		t_hours,w
		movwf		hours		
		bcf		KBflags,3	
		bcf		PORTD,4
		bcf		PORTD,5		
		btfss		KBflags2,1	
		goto		cmd_good
		bcf		KBflags2,1	
		bcf		KBflags,2	
		movf		card_data8,w
		call		BCD_byte
		movf		mins,w	
		cpfsgt		Lbyte
		goto		cmd_good

		incf		hoursL,f
		btfsc		STATUS,C
		incf		hoursH
		goto		cmd_good

kb_ckcmd3	movlw		0x34		
		cpfseq		kb_cmd
		goto		kb_ckcmd4
		call		BCDtoB		
		movf		Lbyte,w
		movwf		hoursL
		movf		Hbyte,w
		movwf		hoursH
		bcf		KBflags,4	
		bcf		PORTD,4
		bcf		PORTD,5		
	
		movf		hoursH,w
		movwf		EEDATA
		movlw		0x08
		call		EE_write
		movf		hoursL,w
		movwf		EEDATA
		movlw		0x09
		call		EE_write
		goto		cmd_good

kb_ckcmd4	movlw		0x91		
		cpfseq		kb_cmd
		goto		kb_ckcmd5
		movlw		0x99
		cpfseq		digit21
		goto		cmd4end		
		movlw		0x99
		cpfseq		digit43
		goto		cmd4end		
		movlw		0x99
		cpfseq		digit65
		goto		cmd4end			
		call		EE_reset
		goto		cmd_good
cmd4end		nop
kb_ckcmd5	movlw		0x01		
		cpfseq		kb_cmd
		goto		kb_ckcmd6
		movf		digit21,w
		movwf		cdig21
		movf		digit43,w
		movwf		cdig43
		movf		digit65,w
		movwf		cdig65
		bsf		KBflags2,0		
		goto		kb_prtn
kb_ckcmd5v	bcf		KBflags2,0
		movf		digit21,w
		cpfseq		cdig21
		goto		cmd_error
		movf		digit43,w
		cpfseq		cdig43
		goto		cmd_error
		movf		digit65,w
		cpfseq		cdig65
		goto		cmd_error
	 	movf		cdig65,w
	 	movwf		EEDATA
	 	movlw		0x10
	 	call		EE_write	
	 	movf		cdig43,w
	 	movwf		EEDATA
	 	movlw		0x11
	 	call		EE_write
	 	movf		cdig21,w
	 	movwf		EEDATA
	 	movlw		0x12
	 	call		EE_write
		goto		cmd_good						
;		return
kb_ckcmd6	nop
		movlw		0x81		
		cpfseq		kb_cmd
		goto		kb_ckcmd7
		movf		digit21,w
		call		BCD_byte
		movf		Lbyte,w		
		movwf		ven_id
		movwf		EEDATA
		movlw		0x07
		call		EE_write
		goto		cmd_good
		nop

		nop		
kb_ckcmd7	nop
		movlw		0x85		
		cpfseq		kb_cmd
		goto		kb_ckcmd8
		movf		digit21,w
		call		BCD_byte
		movf		Lbyte,w		
		movwf		un_t
		movwf		EEDATA
		movlw		0x04
		call		EE_write
		goto		cmd_good

		nop
kb_ckcmd8	nop



kb_prtn1	nop
		btfsc		KBflags,2
		goto		kb_prtn


		movf		kb_cmd,w	
		iorwf		kb_cmd_H,w
		btfsc		STATUS,Z
		goto		kb_code_no
		movf		digit21,w		
		iorwf		digit43,w
		iorwf		digit65,w
		iorwf		digit87,w
		btfsc		STATUS,Z
		goto		kb_code_no
		nop

		movf		kb_cmd_H,w		
		movwf		dataout1
		movf		kb_cmd,w
		movwf		dataout2
		movf		digit87,w
		movwf		dataout3
		movf		digit65,w
		movwf		dataout4
		movf		digit43,w
		movwf		dataout5
		movf		digit21,w
		movwf		dataout6
;		movlw		0x01		
;		movwf		dataout7
		bsf		dataout8,0
;		clrf		dataout8
		call		Dataxfer		; transfer
		bcf		LATD,4		
		bsf		PORTD,7		
		call		beep_ok			; signal
		call		SUdly
		bcf		PORTD,7		
;
kb_prtn		nop
kb_code_no	call		clr_digits
		bcf		KBflags,1		
		bcf		LATD,6		
		return	

cmd_error	btfss		KBflags2,1	
		goto		cmd_err1
		bcf		KBflags2,1	
		bcf		KBflags,2	
cmd_err1	call		beep_error		
		goto		kb_prtn	
cmd_good	call		beep_ok					
		goto		kb_prtn	

;

MainLoopcf			nop	
MainLoop			nop	



				movlw		0x07
				call		EE_read
				movf		EEDATA,w
				movwf		venue_id
				movlw		0xFF
				cpfseq		venue_id
				goto		progb1
				movlw		set_venue_id
				movwf		venue_id
progb1				movlw		0x04
				call		EE_read
				movf		EEDATA,w		
				movwf		un_t			
;
				btfss		PORTC,4
				goto		progbutton
				movlw		d'100'		
				call 		ms_dly
				btfss		PORTC,4		
				goto		progbutton
				bsf		KBflags,2	
progbutton			nop								
;	
				clrwdt+
				call		Keypad		
				nop
				call		kb_program
				nop

				bcf		LATD,5			
				bsf		LATD,4
;
card_rd1			nop
				goto		MainLoop
;
;

;

Keypad				nop
				call	kbscan
				nop
				movf	KBrow1,w
				iorwf	KBrow2,w
				iorwf	KBrow3,w
				btfss	STATUS,Z
				goto	KB1
				goto	KBend

KB1				btfsc	KBflags,0			; don't scan for held key
				return
				call	kbdecode	
				movwf	lastdig
				call	dly2				; delay between scans
				call	kbscan
				nop
				call	kbdecode
				nop
				xorwf	lastdig,w			; check to see second scan matches first
				btfss	STATUS,Z
				return
kbsig				nop
				movlw	0xFF				; check to see a valid keypress was detected
				xorwf	lastdig,w
				btfsc	STATUS,Z
				return
				movlw	0x0B				; check for enter key detected
				xorwf	lastdig,w
				btfss	STATUS,Z
				goto	kb_ck2
				movf	digit21,w
				movwf	kb_cmd			
				movf	digit43,w
				movwf	kb_cmd_H
				call	clr_digitsc			; clear other key data
;				call	KPbeep
				goto	digsig

kb_ck2				movlw	0x0A				; check for enter key detected
				xorwf	lastdig,w
				btfss	STATUS,Z
				goto	digshft1
				bsf	KBflags,1
;				call	KPbeep
				goto	digsig
				
digshft1			movlw	kbtimeout
				btfsc	KBflags,2			
				movlw	progtimeout
				movwf	kb_timer	
				movlw	0x05
				movwf	kbtemp
digshft				dcfsnz	kbtemp
				goto	digadd
				bcf	STATUS,C			; clear carry
				RLCF	digit21
				RLCF	digit43
				RLCF	digit65
				RLCF	digit87
				RLCF	digit09
				RLCF	digitBA
				RLCF	digitDC
				goto	digshft
digadd				movlw	0x0F
				andwf	lastdig,w
				iorwf	digit21
digsig				bsf	KBflags,0
				nop
				movlw	0x01
digsig1				call	KPbeep
				clrf	KBrow1
				clrf	KBrow2
				clrf	KBrow3
				nop		
				return
			
				nop
KBend				nop
				bcf		KBflags,0		; clear key depressed flag				
				return

kbscan				nop
				movlw	b'00100000'
				andwf	PORTA,f
				clrf	PORTB,1
				clrf	PORTB,2
				clrf	PORTB,3
				clrf	KBrow1
				clrf	KBrow2
				clrf	KBrow3
;	row1
				nop
				bsf	PORTB,1
				call	dly2		
				movf	PORTA,w
				movwf	KBrow1
				bcf	PORTB,1
; 	row2			
				nop
				bsf	PORTB,2
				call	dly2		
				movf	PORTA,w
				movwf	KBrow2
				bcf	PORTB,2
;	row3
				nop
				bsf	PORTB,3
				call	dly2		
				movf	PORTA,w
				movwf	KBrow3
				bcf	PORTB,3	
				nop
				return


kbdecode			nop
				movlw	0x01
				btfsc	KBrow1,0
				goto	kbdigit
				movlw	0x04
				btfsc	KBrow1,1
				goto	kbdigit
				movlw	0x07
				btfsc	KBrow1,2
				goto	kbdigit
				movlw	0x0A
				btfsc	KBrow1,3
				goto	kbdigit

				movlw	0x02
				btfsc	KBrow2,0
				goto	kbdigit
				movlw	0x05
				btfsc	KBrow2,1
				goto	kbdigit
				movlw	0x08
				btfsc	KBrow2,2
				goto	kbdigit
				movlw	0x00
				btfsc	KBrow2,3
				goto	kbdigit

				movlw	0x03
				btfsc	KBrow3,0
				goto	kbdigit
				movlw	0x06
				btfsc	KBrow3,1
				goto	kbdigit
				movlw	0x09
				btfsc	KBrow3,2
				goto	kbdigit
				movlw	0x0B
				btfsc	KBrow3,3
				goto	kbdigit

				movlw	0xFF
kbdigit				return


; 
EE_read				movwf	EEADR
				bcf	EECON1, EEPGD
				bcf	EECON1, CFGS
				bsf	EECON1, RD
				return
;				
EE_write			movwf	EEADR
				bcf	EECON1, EEPGD
				bcf	EECON1, CFGS
				bsf	EECON1, WREN
				
				movlw	0x55
				movwf	EECON2
				movlw	0xAA
				movwf	EECON2
				bsf	EECON1, WR
				movlw	0x03		
				call	ms_dly
				bcf	EECON1, WREN
				return


;
EE_reset			nop
				movlw	kbtimeout
				movwf	EEDATA
				movlw	0x01
				call	EE_write
				movlw	progtimeout
				movwf	EEDATA
				movlw	0x02
				call	EE_write
				movlw	unlock_IT
				movwf	EEDATA
				movlw	0x03
				call	EE_write
				movlw	unlock_time
				movwf	EEDATA
				movlw	0x04
				call	EE_write
	
				movlw	0x12		
				movwf	EEDATA
				movlw	0x10
				call	EE_write
				movlw	0x34
				movwf	EEDATA
				movlw	0x11
				call	EE_write
				movlw	0x56
				movwf	EEDATA
				movlw	0x12
				call	EE_write
				nop
				return


;----------------------------------------------------------------------------

Initcode			clrf		PORTA
				clrf		PORTB
				clrf		PORTC
				clrf		PORTD
				clrf		PORTE
				movlw		0x0F			; set A/D port to digital
				movwf		ADCON1
				movlw		0x07
				movwf		CMCON			; configure comparitors as digital I/O
				movlw		IOA			; configure porta
				movwf		TRISA
				movlw		IOB			; configure portb
				movwf		TRISB
				movlw		IOC			; configure portc
				movwf		TRISC
				movlw		IOD			; configure portd
				movwf		TRISD	
				movlw		IOE			; configure porte
				movwf		TRISE

				movlw		0xFF
				movwf		begin_ram
				lfsr		FSR0,begin_ram		; start location of clear
clr_reg1			clrf		POSTINC0
				decfsz     	begin_ram
				bra	     	clr_reg1
				nop
;
				movlw		0x08
				call		EE_read
				movf		EEDATA,w
				movwf		hoursH
				movlw		0x09
				call		EE_read
				movf		EEDATA,w
				movwf		hoursL


				movlw		.200
				movwf		sec_lo
				movlw		.10
				movwf		sec_hi
				movlw		0x10
				call		EE_read
				movlw		0xFF
				cpfseq		EEDATA
				return
				call		EE_reset	
				return
				END

