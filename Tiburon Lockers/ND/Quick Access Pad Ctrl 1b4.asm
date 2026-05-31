;
;=============================================================================
;	Filename:	QP_ctrl1a.asm
;=============================================================================
;	Author: 	C. Hentschel
;	Company:	UplandCompany
;	Revision:	3.00
;	Date:		Mar 14 2012
;	Assembled using MPLAB IDE v7.62
;=============================================================================
;	Include Files:	p18f2420.inc	V1.3
;=============================================================================


		list p=18f4520		;list directive to define processor
		#include <p18f4520.inc>	;processor specific definitions


;/*-----------------------------*/
;/*     source code status      */
;/*-----------------------------*/
;#define UDEV_CODE 1           
;#define EMU_DBG 1             
;#define ICD_DBG 1             


        CONFIG  OSC = HS, IESO = OFF            ; oscillator select,  osc switch enable
        CONFIG  BOREN = OFF, PWRT = OFF         ; brown-out reset,  power-up timer
        CONFIG  CCP2MX = PORTC                  ; ccp2 mux: enable (rc1)
        CONFIG  STVREN = ON, LVP = OFF          ; stack overflow reset,  low voltage icsp
        CONFIG  PBADEN = OFF                    ; config portb <4:0> pins as digital
        CONFIG  WDTPS = 512                     ; watchdog postscaler (512 * 4ms = 2.048s)
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
        CONFIG  CP0=ON, CP1=ON, CP2=ON, CP3=ON          ; code block protection
        CONFIG  CPB=ON, CPD=ON                          ; boot block and data eeprom protection
        CONFIG  WRT0=ON, WRT1=ON, WRT2=ON, WRT3=ON      ; write block protection
        CONFIG  WRTB=ON, WRTC=ON, WRTD=ON               ; boot block and config reg write protection
        CONFIG  EBTR0=ON, EBTR1=ON, EBTR2=ON, EBTR3=ON  ; table read protection
    ENDIF


;Constants


SPBRG_VAL	EQU	.23		
TX_BUF_LEN	EQU	.25		
RX_BUF_LEN	EQU	TX_BUF_LEN
SOP1		EQU	0x7E	
SOP2		EQU	0x1B	
EOP1		EQU	0x81	
EOP2		EQU	0xE4	
PacketDly	EQU	0x08	

TxDly		EQU	0x08		
;
;	firmware version
;
FW1		EQU	0x01		; Rapid access pad build number 0x00 - 0x0F
FW2		EQU	0x41		; A
;
;	Command bytes
;
CMD1		EQU	0x01	
CMD2		EQU 	0x02	
CMD3		EQU	0x03		
CMD4		EQU	0x04		
CMD5		EQU	0x05	
CMD6		EQU	0x06	
CMD7		EQU	0x07		
CMD8		EQU 	0x08	
CMD9		EQU	0x09	
CMDA		EQU	0x0A	
CMDB		EQU 	0x0B		
CMD92		EQU	0x92	
CMDTST		EQU	0xF1	
ANS_DLY		EQU	.100	
;
;
BC_address	EQU	0x00	
BCMD1		EQU	0x8A		

;----------------------------------------------------------------------------
;Bit Definitions - flags

TxBufFull	EQU	0	
TxBufEmpty	EQU	1	
RxBufFull	EQU	2	
RxBufEmpty	EQU	3	
ReceivedCR	EQU	4	
StartPkt	EQU	5		
StartPkt2	EQU	6	
PktTimer	EQU	7	

eop_err	EQU	0	
cs_err	EQU	1	
un_cmd	EQU	2		

force_err	EQU	6	
Door_time	EQU	3	
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
		FSR0H_SHADOW		;to save FSR0H during high interrupt
		FSR0L_SHADOW		;to save FSR0L during high interrupt
		Flags			;byte for indicator flag bits

		Flags1			; additional control flags

		errflag		; additional flag bits


		TempData	
		TempRxData		;temporary data in Rx buffer routines 
		TempTxData		;temporary data in Tx buffer routines 
		TxStartPtrH		;pointer to start of data in Tx buffer
		TxStartPtrL		;pointer to start of data in Tx buffer
		TxEndPtrH		;pointer to end of data in Tx buffer
		TxEndPtrL		;pointer to end of data in Tx buffer
		RxStartPtrH		;pointer to start of data in Rx buffer
		RxStartPtrL		;pointer to start of data in Rx buffer
		RxEndPtrH		;pointer to end of data in Rx buffer
		RxEndPtrL		;pointer to end of data in Rx buffer
		PacketTmr		
		PacketTemp	
		DoorUlocktmrl	
		DoorUlocktmrh
		Rent_stat		
		Motor_stat	

		
		Motor_duty	
		Motor_on_cnt
		Motor_off_cnt

		Rent_new		
		LRent_stat	
		toggle		
		tdly2		
		temp1
		temp2
		temp3
		temp4
		status		
		TxBytes		
		crc_lo		; checksum
		crc_hi		; checksum
		BD_loc	
;
; data transfer registers
;
		Door_loc	
		Door_ult	
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
		tmp_c0
		wrk_c0
		txb_00			;transmit buffers
		txb_01
		txb_02
		txb_03
		txb_04
		txb_05
		txb_06
		txb_07
		txb_08
		txb_09
		txb_0A
		txb_0B
		txb_0C
		txb_0D
		txb_0E
		txb_0F
		txb_10
		txb_11
		txb_12
		txb_13

		txb_cnt			
		tbc_cpy
		txdly1
		door_lo

		rxb_00			; recieve buffers
		rxb_01
		rxb_02
		rxb_03
		rxb_04
		rxb_05
		rxb_06
		rxb_07
		rxb_08
		rxb_09
		rxb_0A
		rxb_0B
		rxb_0C
		rxb_0D
		rxb_0E
		rxb_0F
		rxb_10
		rxb_11
		rxb_12
		rxb_13

		rxb_cnt		
		sec_lo
		sec_hi
		Door_debounce	
		


		TxBuffer:TX_BUF_LEN	;Tx buffer for data to transmit
		RxBuffer:RX_BUF_LEN	;Rx buffer for received data
		ram_end

		ENDC

;----------------------------------------------------------------------------
;	PORT DEFINITIONS
;

;/*----------------------------*/
;/*        i/o mapping         */
;/*----------------------------*/
IOA	equ	B'00001110'	; porta

IOB	equ	B'00110001'	; portb

IOC	equ	B'10110001'	; portc

IOD	equ	B'11111111'	; portd


IOE	equ	B'00000000'	; porte


		ORG     0x0000		;place code at reset vector

  ResetVector:	bra	Main		;go to beginning of program


		ORG	0x0008

HighInt:		bra		HighIntCode	;go to high priority interrupt routine


		ORG	0x0018

LowInt:			movff		STATUS,STATUS_TEMP	;save STATUS register
				movff		WREG,WREG_TEMP		;save working register
				movff		BSR,BSR_TEMP		;save BSR register
				movff		FSR0H,FSR0H_TEMP	;save FSR0H register
				movff		FSR0L,FSR0L_TEMP	;save FSR0L register


				btfss		PIR1,TXIF	
				bra		LowInt1	
				btfsc		PIE1,TXIE	
				bra		PutData	


LowInt1:			reset				
		

PutData:		btfss		Flags,TxBufEmpty 	
			bra		PutDat1	
			bcf		PIE1,TXIE	
			bra		EndLowInt
PutDat1:		movlw		TxDly		
			movwf 		txdly1
			rcall		GetTxBuf
			movwf		TXREG		

EndLowInt:		movff		FSR0L_TEMP,FSR0L	
			movff		FSR0H_TEMP,FSR0H	
			movff		BSR_TEMP,BSR	
			movff		WREG_TEMP,WREG		
			movff		STATUS_TEMP,STATUS	
			retfie

HighIntCode:		movff		FSR0H,FSR0H_SHADOW	
			movff		FSR0L,FSR0L_SHADOW

	
			btfss		PIR1,RCIF	
			bra		HighInt1	
			btfsc		PIE1,RCIE	
			bra		GetData	


HighInt1:		reset				

GetData:		btfsc		RCSTA,OERR		
			bra		ErrOERR		
			btfsc		RCSTA,FERR	
			bra		ErrFERR		
			btfsc		Flags,RxBufFull	
			bra		ErrRxOver		
			movf		RCREG,W		
;

;		

			movf		PacketTmr,W
			btfss		STATUS,Z
			bra		GetData2	
;

CkSOP1			btfsc		Flags,StartPkt	
			bra		CkSOP2			
			movf		RCREG,W				
			movwf		PacketTemp,W
			xorlw		SOP1
			btfsc		STATUS,Z		
			bsf		Flags,StartPkt	
			bra		GetData1	

	
CkSOP2			btfsc		Flags,StartPkt2		
			bra		CkAddr
			movf		RCREG,W		
			movwf		PacketTemp	
			xorlw		SOP2		
			btfsc		STATUS,Z		
			bsf		Flags,StartPkt2
			bra		GetData1	
;
CkAddr			movf		RCREG,W		
			movwf		PacketTemp	
			movf		BD_loc,W
			xorwf		PacketTemp,w	
			btfss		STATUS,Z
			bra		CkAddrFG
			movlw		PacketDly	
			movwf		PacketTmr	
			bcf		Flags,StartPkt
			bcf		Flags,StartPkt2
			bra		GetData1
CkAddrFG		movf		RCREG,W		
			movwf		PacketTemp	
			movlw		BC_address
;			movlw		0xFF		
			xorwf		PacketTemp,w	
			btfss		STATUS,Z
			bra		CkAddrF
			bsf		Motor_stat,7	
			movlw		PacketDly	
			movwf		PacketTmr		
CkAddrF			bcf		Flags,StartPkt
			bcf		Flags,StartPkt2
			bra		GetData1
;	

GetData2		movf		RCREG,W			
			movf		rxb_cnt,f
			btfss		STATUS,Z	
			bra		GetD3
			movwf		rxb_cnt		
			movlw		0x04
			addwf		rxb_cnt,1		
			lfsr		FSR1,rxb_00	

GetD3			nop
			movf		RCREG,W	
			rcall		PutRxBuf
GetData1		nop
			bra		EndHighInt


ErrOERR:		bcf		RCSTA,CREN		
			bsf		RCSTA,CREN	
			bra		EndHighInt


ErrFERR:		movf		RCREG,W	
			bra		EndHighInt

ErrRxOver:		movf		RCREG,W	
			xorlw		0x0d			
			btfsc		STATUS,Z	
			bsf		Flags,ReceivedCR 
			bra		EndHighInt

EndHighInt:		movff		FSR0L_SHADOW,FSR0L	;restore FSR0L register
			movff		FSR0H_SHADOW,FSR0H	;restore FSR0H register
			retfie	FAST				;return and restore context

;
;	
StartSig		movlw		0x04
			movwf		temp2
SSlp1			bsf		PORTB,1
			call		SUdly
			bcf		PORTB,1
			bsf		PORTB,2
			call		SUdly
			bcf		PORTB,2
			decfsz		temp2
			goto		SSlp1
			return

SUdly			movlw		0x80
			movwf		temp1
SUlp1			call		dly2
			decfsz		temp1
			goto		SUlp1
			clrwdt
			return
;
StatusI			nop
			clrf		status
			btfsc		PORTC,4
			bsf		status,0	
			btfsc		PORTC,5
			bsf		status,1
			btfsc		PORTA,2
			bsf		status,2	
			btfsc		PORTA,3
			bsf		status,3	
			btfsc		PORTB,1
			bsf		status,4
			btfsc		PORTB,2
			bsf		status,5	
			btfsc		PORTC,4
			bsf		status,6	
			btfsc		PORTE,2
			bsf		status,7
			movf		status,w	
			return
;
;

dly1			movlw		0x01		; 
			movwf		tdly2
			goto		dly2a
dly2			movlw		0x7F		; 
			movwf		tdly2
dly2a			nop
			nop
			nop
			nop
			decfsz		tdly2,f
			goto		dly2a
			return

;

Dataxfer		btfsc		PORTC,0	
			goto		xfer_end
			nop
			bcf		PORTC,3	
			movlw		0x5A
			movwf		dataout1
			movwf		dataout3
			movwf		dataout5
			movwf		dataout7
			movlw		0xA5
			movwf		dataout2
			movwf		dataout4
			movwf		dataout6
			movwf		dataout8
			movlw		0x40
			movwf		xfercnt
			bcf		PORTC,3

xfer1			nop
			bsf		PORTA,0
			rrcf		dataout1
			rrcf		dataout2
			rrcf		dataout3
			rrcf		dataout4
			rrcf		dataout5
			rrcf		dataout6
			rrcf		dataout7
			rrcf		dataout8
			btfss		STATUS,C
			bcf		PORTA,0
				
			bcf		STATUS,C
			btfsc		PORTA,1		; check data line
			bsf		STATUS,C
			rrcf		datain1
			rrcf		datain2
			rrcf		datain3
			rrcf		datain4
			rrcf		datain5
			rrcf		datain6
			rrcf		datain7
			rrcf		datain8
				
			bsf		PORTC,3		; set data clock high
			call		dly1
			nop
			bcf		PORTC,3		; set data clock low
			call		dly1
			decfsz 		xfercnt
			goto		xfer1
xfer_end		nop

			return

;

Main:			nop
			call		Initcode	
Main_dly		nop			
			clrwdt			
			movf		PORTD,w
			movwf		temp2
			andlw		0x0F
			movwf		temp2
			swapf		temp2
m_dly1			call		SUdly
			decfsz		temp2
			goto		m_dly1
			nop

			movlw		0x20
			movwf		Rent_stat
			call		StartSig	; signal startup
;
MainLoop:		nop
			clrwdt
			call		Dataxfer
; 

			movf		PORTD,w
			andlw		0x0F	
			iorlw		0xF0	
;			movlw		0xFE	
			movwf		BD_loc

			btfsc		datain8,0
			goto		tst2		
			btfsc		datain8,1
			goto		tst3
			goto		tst1


tst3			clrf		datain8	
			movf		datain6,w
			movwf		BD_loc	
			movf		datain7,w
			movwf		Door_ult
			call		BuildUlockBuf
			call		bld_crc	
			nop
			goto		replysp3

tst2			clrf		datain8
			goto		Build_rply	
			nop
tst1			nop
; 
			call		dly2
			decfsz		sec_lo
			goto		ML3
			movlw		.200		
			movwf		sec_lo
			incf		toggle,f	
			decfsz		sec_hi
			goto		ML3
			movlw		.10		
			movwf		sec_hi
;
			movf		DoorUlocktmrh,f
			btfss		STATUS,Z			
			goto		MLt1				
			movf		DoorUlocktmrl,f	
			btfsc		STATUS,Z
			goto		ML3			
;

MLt1			nop

			


			nop
			decf		DoorUlocktmrl,f
			btfss		STATUS,C
			decf		DoorUlocktmrh,f
			nop
			movf		DoorUlocktmrl
			btfss		STATUS,Z
			goto		ML3
			movf		DoorUlocktmrh,f
			btfss		STATUS,Z
			goto		ML3
;

;ML2
			bcf		PORTB,1		
			bcf		PORTB,2		
			bsf		Motor_stat,1	
			movf		LRent_stat,w
			movwf		Rent_stat			

;

;
ML2			nop

;
ML3			nop
;	
	
			movf		PacketTmr,f
			btfsc		STATUS,Z
			bra		Tmrrtn
			call		dly2
			decfsz		PacketTmr,f
			bra		Tmrrtn1
Tmrrtn			nop
			clrf		rxb_cnt			
Tmrrtn1			nop
;
;
			btfss		Flags,ReceivedCR 	
			goto		MainLoop1
;

ckCMD0			nop
			bcf		Motor_stat,7		
			movlw		CMD1		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD2
		
			movlw		EOP1
			xorwf		rxb_05
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_06
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		ckCMD3		

			movf		rxb_02,w
			btfsc		STATUS,Z
			goto		ckCMD3		
			movwf		DoorUlocktmrl		
			clrf		DoorUlocktmrh
			movf		Rent_stat,w		
			movwf		LRent_stat	
			movlw		0x02
			movwf		Rent_stat	
			bsf		Motor_stat,0	  	
			clrf		Motor_stat
			bsf		Motor_stat,0

			nop
			goto		ckCMD3

ckCMD2			movlw		CMD2			
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD3
			movlw		EOP1
			xorwf		rxb_04
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_05
			btfss		STATUS,Z
			bsf		errflag,eop_err
			bcf		Flags,ReceivedCR
			goto		replyspl		

ckCMD3			movlw		CMD92		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD4
			movlw		EOP1
			xorwf		rxb_04
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_05
			btfss		STATUS,Z
			bsf		errflag,eop_err
			bcf		Flags,ReceivedCR	
			bsf		Flags1,1	
			goto		replyspl		


ckCMD4			bcf		Flags,ReceivedCR	
			clrf		PacketTmr
			bra		MainLoop

;
Build_rply		nop
			call		BuildKeyBuf
			nop
;
			call		bld_crc		
			bsf		Flags1,0	
			nop
			bra		MainLoop
;

replyspl		nop	

rep_01			clrf		PacketTmr	
			btfsc		Flags1,0		
			goto		replysp2
			call		BuildTxBuf
			call		bld_crc			
replysp3		bcf		Flags1,1	
			
replysp2		bcf		Flags1,0
			lfsr		FSR1,txb_00	
			clrf		errflag		

			clrf		PacketTmr	
			bsf		PORTA,5			
			call		dly2			
			movlw		TxDly
			movwf		txdly1
			nop
			bcf		Flags,ReceivedCR
			bcf		Flags,TxBufEmpty 
			bsf		PIE1,TXIE	
;		
MainLoop1		nop

TXsend_dly		nop			
			call		dly2			
			decfsz		txdly1
			goto		TXsend_dly

MainLoop2		bcf		PORTA,5		
			bsf		PIE1,RCIE	
			nop
			bra		MainLoop		

;
BuildTxBuf		nop
			movlw		0x0A
			movwf		TxBytes
			movlw		SOP1	
			movwf		txb_00
			movlw		SOP2		
			movwf		txb_01
			movf		BD_loc,W
			movwf		txb_02
;
			movlw		0x03		
			movwf		txb_03
			movf		rxb_01,w
			movwf		txb_04
;

Btx1			swapf 		PORTD,w
			andlw		0xF0
			iorlw		FW1	
			nop
			movwf		txb_05
			movlw		0x34	
			movwf		txb_06
			movlw		0x35	
			movwf		txb_07
			movlw		EOP1
			movwf		txb_08
			movlw		EOP2
			movwf		txb_09
			lfsr		FSR1,txb_00		
			clrf		errflag			
			clrf		PacketTmr
			return
;
;
BuildUlockBuf		nop
			movlw		0x0A
			movwf		TxBytes
			movlw		SOP1			
			movwf		txb_00
			movlw		SOP2			
			movwf		txb_01
			movf		BD_loc,W
			movwf		txb_02
;
;
			movlw		0x03			
			movwf		txb_03
			movlw		0x01			
			movwf		txb_04
;
;
Btx2			movf		Door_ult,w
			movwf		txb_05
			movlw		0x34			
			movwf		txb_06
			movlw		0x35			
			movwf		txb_07
			movlw		EOP1
			movwf		txb_08
			movlw		EOP2
			movwf		txb_09
			lfsr		FSR1,txb_00		
			clrf		errflag			
			clrf		PacketTmr
			return
;
;
;

BuildKeyBuf		nop
			movlw		0x0F
			movwf		TxBytes
			movlw		SOP1			
			movwf		txb_00
			movlw		SOP2			
			movwf		txb_01
			movf		BD_loc,W
			movwf		txb_02
;
;
			movlw		0x08			
			movwf		txb_03
			movlw		0x91			
			movwf		txb_04
			movf		datain1,w
			movwf		txb_05
			movf		datain2,w
			movwf		txb_06
			movf		datain3,w
			movwf		txb_07
			movf		datain4,w
			movwf		txb_08
			movf		datain5,w
			movwf		txb_09
			movf		datain6,w
			movwf		txb_0A
			movlw		0x34				
			movwf		txb_0B
			movwf		txb_0C
			movlw		EOP1
			movwf		txb_0D
			movlw		EOP2
			movwf		txb_0E
			lfsr		FSR1,txb_00		
			clrf		errflag			
			clrf		PacketTmr
			return
;
;
GetTxBuf		movlw		TxDly	
			movwf		txdly1			
			movf		POSTINC1,w
			nop
			decfsz		TxBytes
			return
			bsf		Flags,TxBufEmpty
;			bcf		PIE1,RCIE		
			nop
			return
;

PutRxBuf		nop
			movwf		POSTINC1
			decfsz		rxb_cnt
			bra		PutRx1
			nop
			bsf		Flags,ReceivedCR	
;			call		BuildTxBuf
PutRx1			nop
			return
	

SetupSerial:		movlw		0xc0		
			iorwf		TRISC,F
			movlw		SPBRG_VAL		
			movwf		SPBRG
			movlw		0x24		
			movwf		TXSTA
			movlw		0x90		
			movwf		RCSTA
			clrf		Flags		
			movlw		0x30			
			movwf		PIE1
			movlw		0x20		
			movwf		IPR1
			bsf			RCON,IPEN		
			movlw		0xc0		
			movwf		INTCON
			return


;----------------------------------------------------------------------------

Initcode		clrf		PORTA
			clrf		PORTB
			clrf		PORTC
			clrf		PORTD
			clrf		PORTE
			clrf		PacketTmr
			clrf		Flags
			rcall		SetupSerial	
;
;
			movlw		0x0F		
			movwf		ADCON1
			movlw		0x07
			movwf		CMCON	
			movlw		IOA		; configure porta
			movwf		TRISA

			movlw		IOB		; configure porta
			movwf		TRISB
			movlw		IOC		; configure porta
			movwf		TRISC
			movlw		IOD		; configure porta
			movwf		TRISD
			movlw		IOE		; configure porta
			movwf		TRISE

			movlw		0xFF
			movwf		begin_ram
			lfsr		FSR0,begin_ram	
clr_reg1		clrf		POSTINC0
			decfsz      	begin_ram
			bra	      	clr_reg1
			nop

			movlw		.200
			movwf		sec_lo
			movlw		.10
			movwf		sec_hi
			movlw		Door_time		
			movwf		Door_debounce


			bcf		PORTA,5	
			clrf		DoorUlocktmrl
			clrf		DoorUlocktmrh
			clrf		PacketTmr
			clrf		txdly1
			clrf		rxb_cnt
			return



bld_crc			movf		txb_03,w	
			addlw		1			
			movwf		wrk_c0	

			movlw		0xFF		
			movwf		crc_hi
			movwf		crc_lo	

			lfsr		FSR0,txb_00+2	
bld_crc1		movf		POSTINC0,w
			call		crc_ab		
			decfsz		wrk_c0
			bra		bld_crc1

			movf		crc_hi,w
			movwf		POSTINC0
			movf		crc_lo,w
			movwf		POSTINC0
     			return
;
;
;
ck_crc			movf		rxb_00,w		
			nop
;			addlw		1			
			movwf		wrk_c0
			movlw		0xFF		
			movwf		crc_hi
			movwf		crc_lo
			movf		BD_loc,w
			btfsc		Motor_stat,7	
			movlw		BC_address
;			movlw		0xFF
			call		crc_ab
			lfsr		FSR0,rxb_00		
ck_crc1			movf		POSTINC0,w
			call		crc_ab			
			decfsz		wrk_c0
			bra			ck_crc1
			
			nop
			movf		POSTINC0,w		
			xorwf		crc_hi,w
			btfss		STATUS,Z	
			goto 		crc_err
			movf		POSTINC0,w
			xorwf		crc_lo,w
			btfss		STATUS,Z	
			goto 		crc_err			
			movlw		0x00
			return
crc_err			movlw		0xFF
			return
		
crc_ab			xorwf		crc_hi,w
			movwf		tmp_c0
			andlw		0xF0
			swapf		tmp_c0
			xorwf		tmp_c0

			movf		tmp_c0,w
			andlw		0xF0
			xorwf		crc_lo,w
			movwf		crc_hi

			rlcf		tmp_c0,w
			rlcf		tmp_c0,w
			xorwf		crc_hi
			andlw		0xE0
			xorwf		crc_hi

			swapf		tmp_c0
			xorwf		tmp_c0,w
			movwf		crc_lo
			return


			END

