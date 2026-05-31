;
;=============================================================================
;	Filename:	CS bd dev rev 3 
;=============================================================================
;	Author: 	C. Hentschel
;	Company:	UplandCompany
;	Revision:	3.00
;	Date:		
;	Assembled using MPLAB IDE v8.83
;=============================================================================
;	Include Files:	p18f2420.inc	V1.3
;=============================================================================

		list p=18f4520		;list directive to define processor
		#include <p18f4520.inc>	;processor specific definitions



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
        CONFIG  PBADEN = OFF                   
        CONFIG  WDTPS = 512                     
        CONFIG  EBTRB=OFF                       ; boot block table read protection;

    IFDEF ICD_DBG
        CONFIG  DEBUG=ON                                
        CONFIG  WDT=OFF                                 ; watchdog timer disabled
        CONFIG  CP0=OFF, CP1=OFF, CP2=OFF, CP3=OFF      ; code block protection
        CONFIG  CPB=OFF, CPD=OFF                        ; boot block and data eeprom protection
        CONFIG  WRT0=OFF, WRT1=OFF, WRT2=OFF, WRT3=OFF  ; write block protection
        CONFIG  WRTB=OFF, WRTC=OFF, WRTD=OFF            ; boot block and config reg write protection
        CONFIG  EBTR0=OFF, EBTR1=OFF, EBTR2=OFF, EBTR3=OFF  
    ELSE
        CONFIG  DEBUG=OFF
        CONFIG  WDT=ON
        CONFIG  CP0=ON, CP1=ON, CP2=ON, CP3=ON          ; code block protection
        CONFIG  CPB=OFF, CPD=OFF                        ; boot block and data eeprom protection
        CONFIG  WRT0=ON, WRT1=ON, WRT2=ON, WRT3=ON      ; write block protection
        CONFIG  WRTB=ON, WRTC=ON, WRTD=OFF               ; boot block and config reg write protection

        CONFIG  EBTR0=ON, EBTR1=ON, EBTR2=ON, EBTR3=ON  
    ENDIF


;Constants


SPBRG_VAL	EQU	.23			
TX_BUF_LEN	EQU	.25		
RX_BUF_LEN	EQU	TX_BUF_LEN
SOP1		EQU	0x7E		
SOP2		EQU	0x1B	
EOP1		EQU	0x81	
EOP2		EQU	0xE4	
PacketDly	EQU	0x10		

TxDly		EQU	0x08	
;
;	firmware version
;
FW1		EQU	0X56		; ascii "V"	
FW2		EQU	0x33		; CS version ascii byte 1 "3"
FW3		EQU	0x48		; CS version ascii byte 2 "H"
;
;	Command bytes
;
CMD1		EQU	0x60	
CMD2		EQU 0x61		
CMD3		EQU	0x62		
CMD4		EQU	0x63		
CMD5		EQU	0x64		
CMD6		EQU	0x65		
CMD7		EQU	0x66		
CMD8		EQU	0x67		
CMD9		EQU	0x68		
CMD10		EQU	0x69		
CMD11		EQU	0xF0		
CMDTST		EQU	0xF1		
ANS_DLY		EQU	.100		
;
;
BC_address	EQU	0x00		
BCMD1		EQU	0x8A		


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

red		EQU	0
green		EQU	1
blue		EQU	2
white		EQU	3
handlw		EQU	4
chg_done_init	EQU	0x19		



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
; 				
		Flags1			; additional control flags
			
;
		errflag		; additional flag bits

		TempData		;temporary data in main routines 
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
		PacketTmr		; Packet timer byte
		PacketTemp		; recieved data temp register
		DoorUlocktmr		; duration to power lock low byte
		Motor_stat		; motor status


		led_status
		sys_status	
					
		sys_status1		
		sys_status2		
		chgtmrl		
		chgtmrh			
		last_cmd	

		cmd10_sec	
		Volt_H		
		Volt_L

		Sum_L
		Sum_H
		Sum_cnt
		Sum_result_L	
		Sum_result_H
		chg_done	
	
;

		toggle	
		tdly2		
		temp1
		temp2
		temp3
		temp4
		status	
		TxBytes		
		crc_lo	
		crc_hi	
		BD_loc		
		Address_mask
		Address_mask2
;
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
		txb_00		
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

		rxb_00		
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

;

		EE00		
		EE01		
		EE02		
		EE03		
		EE04		
		EE05		
		EE06		
		EE07		
		EE08		
		EE09		
		EE0A			
		c_off_sec		
		

		TxBuffer:TX_BUF_LEN	
		RxBuffer:RX_BUF_LEN	
		ram_end

		ENDC


;/*----------------------------*/
;/*        i/o mapping         */
;/*----------------------------*/
IOA	equ	B'00001110'	; porta

IOB	equ	B'00000111'	; portb

IOC	equ	B'10000000'	; portc

IOD	equ	B'11111111'	; portd

IOE	equ	B'00000010'	; porte

		ORG     0x0000		

ResetVector:	bra	Main		

		ORG	0x0008

HighInt:		bra		HighIntCode


		ORG	0x0018

LowInt:				movff		STATUS,STATUS_TEMP	
				movff		WREG,WREG_TEMP		
				movff		BSR,BSR_TEMP	
				movff		FSR0H,FSR0H_TEMP	
				movff		FSR0L,FSR0L_TEMP	

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
			movf		PacketTmr,W
			btfss		STATUS,Z
			bra		GetData2	
;
;	Check for start characters
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
; 	Check device address
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
CkAddrFG		nop

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


EndHighInt:		movff		FSR0L_SHADOW,FSR0L	
			movff		FSR0H_SHADOW,FSR0H	
			retfie	FAST			

;
;	

StartSig		movlw		0x01
			movwf		temp3
			bsf			PORTC,1   
SSlp1			bsf			PORTC,4		
			call		SUdlyL
			bcf			PORTC,4
			bsf			PORTC,2	
			call		SUdlyL
			bcf			PORTC,2
			bsf			PORTC,3	
			call		SUdlyL
			bcf			PORTC,3
			bsf			PORTC,0	
			call		SUdlyL
			bcf			PORTC,0
			bsf			PORTC,5	
			call		SUdlyL
			bcf			PORTC,5
			decfsz		temp3
			goto		SSlp1
			return


;

bld_status		nop
			clrf		sys_status
			bsf		sys_status,2 	
			btfsc		Flags1,7	
			bsf		sys_status,0		
			btfsc		PORTB,0		
			bsf		sys_status,1
			btfss		Flags1,6	
			bcf		sys_status,2
			btfsc		Flags1,5	
			bsf		sys_status,3
			btfsc		led_status,0	
			bsf		sys_status,4		
			btfsc		led_status,1	
			bsf		sys_status,5
			btfsc		led_status,2	
			bsf		sys_status,6
			btfsc		led_status,3	
			bsf		sys_status,7
;
			movwf		sys_status1

			bcf		sys_status2,7
			bcf		sys_status2,6	
			btfsc		sys_status,7		
			bsf		sys_status2,7
			btfsc		sys_status,6
			bsf		sys_status2,6

			return




SUdlyL			movlw		0x08
			movwf		temp2

SU2L			movlw		0x80
			movwf		temp1
SUAL			call		dly2
			decfsz		temp1
			goto		SUAL
			clrwdt
			decfsz		temp2
			goto		SU2L
			return



SUdly			movlw		0x80
			movwf		temp1
SUlp1			call		dly2
			decfsz		temp1
			goto		SUlp1
			clrwdt
			return
;
MSdly			nop
			movwf		temp3	
MS1			call		dly2	
			call		dly2
			decfsz		temp3
			goto		MS1
			return
;
;
dly1			movlw		0x01	
			movwf		tdly2
			goto		dly2a
dly2			movlw		0x7B	 
			movwf		tdly2

dly2a			nop
			nop
			nop
			nop
			decfsz		tdly2,f
			goto		dly2a
			return

unlock			nop

			bsf		PORTB,5	
			bsf		PORTE,0	
			call		SUdly
			call		SUdly
			call		SUdly
			call		SUdly
			bcf		PORTB,5	
			bsf		Flags1,7	
			return

lock			nop
			bcf		PORTB,5	
			bcf		PORTE,0		
			bcf		Flags1,7

			return
;

Main:			nop
			call		Initcode
			bsf		sys_status2,5


Main_dly		nop
			clrwdt	
			call		StartSig
			call		READ_data  	
;

			clrf		chgtmrl
			clrf		chgtmrh
			clrf		DoorUlocktmr
			movf		EE00,w
			movwf		led_status
;
MainLoop:		nop
			clrwdt

			nop
			bsf		LATC,1

			btfss		led_status,7
			goto		led_1

			nop
			bcf		LATC,1
			btfsc		toggle,1
			bsf		LATC,1

led_1			nop
			bcf		PORTC,0	
			bcf		PORTC,2	
			bcf		PORTC,3	
			bcf		PORTC,4	
			bcf		PORTC,5	
;
			btfsc		led_status,0
			bsf		PORTC,0
			btfsc		led_status,1
			bsf		PORTC,2
			btfsc		led_status,2
			bsf		PORTC,3
			btfsc		led_status,3
			bsf		PORTC,4
			btfsc		led_status,4
			bsf		PORTC,5
			
; 
			movf		EE0A,w
			movwf		Address_mask2  	
			movf		PORTD,w
			andwf		Address_mask,w	
			andwf		Address_mask2,w
			movwf		BD_loc
;
			btfss		PORTB,2
			goto		SWck_end
			call		unlock
			movlw		d'200'
			call		MSdly
			movlw		d'200'
			call		MSdly
			movlw		d'200'
			call		MSdly
			call		lock
SWck_end		nop
;
cmdtst1			nop
			movlw		0x02		
			xorwf		last_cmd,w
			btfss		STATUS,Z
			goto		cmdtst2
			btfsc		PORTB,0		
			goto		cmdtst1a
			movlw		0xFF		
			call		MSdly
			movlw		0xFF		
			call		MSdly

			btfsc		PORTB,0		
			goto		cmdtst1a
			call		lock
			clrf		DoorUlocktmr
			movf		EE03,w
			movwf		led_status
			bsf		Flags1,1	
			bsf		Flags1,6	
			goto		cmdtstend
cmdtst1a		btfss		Flags1,1
			goto		cmdtstend			
			movf		EE04,w
			movwf		led_status
			clrf		last_cmd
;			movlw		c_timeout_H
			movf		EE08,w
			movwf		chgtmrh
;			movlw		c_timeout_L
			movf		EE09,w
			movwf		chgtmrl			
			goto		cmdtstend	

cmdtst2			nop
			movlw		0x03			
			xorwf		last_cmd,w
			btfss		STATUS,Z
			goto		cmdtst3
			btfsc		PORTB,0			
			goto		cmdtst2a
			movlw		0xFF			
			call		MSdly
			movlw		0xFF		
			call		MSdly
			btfsc		PORTB,0		
			goto		cmdtst2a
			call		lock		
			clrf		DoorUlocktmr
			movf		EE03,w
			movwf		led_status
			bsf		Flags1,2
			bsf		Flags1,6	
			goto		cmdtstend
cmdtst2a		btfss		Flags1,2
			goto		cmdtstend
			movf		EE01,w
			movwf		led_status
			clrf		chgtmrl
			clrf		chgtmrh

			bcf		Flags1,1
			bcf		Flags1,2
			goto		cmdtstend			

cmdtst3			nop
			movlw		0x04		
			xorwf		last_cmd,w
			btfss		STATUS,Z
			goto		cmdtstend

cmdtstend		nop

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
			call		READ_data 
			call		current_V	
;
			movf		cmd10_sec,f
			btfsc		STATUS,Z
			goto		cmd_off_end
			decfsz		cmd10_sec
			goto		c_off_end
			call		lock
cmd_off_end		nop

;
			movf		c_off_sec,f
			btfsc		STATUS,Z
			goto		c_off_end
			decfsz		c_off_sec
			goto		c_off_end
			bcf		PORTE,2		
c_off_end		nop


			movf		chgtmrh,f
			btfss		STATUS,Z	
			goto		chgdec		
			movf		chgtmrl,f	
			btfsc		STATUS,Z
			goto		ML3A			
chgdec			nop
;
			nop
			decf		chgtmrl,f
			btfss		STATUS,C
			decf		chgtmrh,f
			movf		chgtmrl
			btfss		STATUS,Z
			goto		chgdec2
			movf		chgtmrh,f
			btfss		STATUS,Z
			goto		chgdec2

			movf		EE05,w
			movwf		led_status
chgdec2			nop
;

;
ML3A			movf		DoorUlocktmr,f
			btfsc		STATUS,Z			
			goto		ML3				
			decfsz		DoorUlocktmr			
			goto		ML3
			call		lock
;			movlw		LA_leds
			movf		EE01,w
			movwf		led_status	
		
			clrf		last_cmd
			bsf		Flags1,5	
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
			goto		MainLoop
;

chtest			nop
			call		ck_crc		
			addlw		0x00
			btfsc		STATUS,Z
			goto		ckCMD1
			bcf		Flags,ReceivedCR
			goto		MainLoop	
;

ckCMD1			nop
			movlw		CMD1		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD2
			movlw		EOP1
			xorwf		rxb_04,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		
			nop
			goto		replyspl	
;			goto		CMDend

ckCMD2			nop
			movlw		CMD2		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD3
			movlw		EOP1
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_06,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		
;
			nop
			bsf		PORTE,2		
			movlw		0x02
			movwf		last_cmd
			bcf		Flags1,6	
			bcf		Flags1,5		
			movf		rxb_02,w
			movwf		DoorUlocktmr	
			movf		EE02,w
			movwf		led_status
			call		unlock
			nop
			goto		replyspl	

ckCMD3			nop
			movlw		CMD3		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD4
			movlw		EOP1
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_06,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		
			nop
			movlw		0x03
			movwf		last_cmd
			bcf		Flags1,5	
			bcf		Flags1,6	
			movf		rxb_02,w
			movwf		DoorUlocktmr
			movf		EE06,w
			movwf		led_status
			call		unlock
			movf		EE07,w
			movwf		c_off_sec			
			nop
			goto		replyspl	

ckCMD4
			movlw		CMD4		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD5
			movlw		EOP1
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_06,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		
			bsf		Flags1,6	
			movf		rxb_02,w
			movwf		led_status
			bcf		sys_status2,5	
			goto		replyspl	

ckCMD5			nop
			movlw		CMD5		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD6
			movlw		EOP1
			xorwf		rxb_04,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	 
			btfss		STATUS,Z
			goto		CMDend		

			bcf		PORTE,2		

			movf		EE01,w
			movwf		led_status

			clrf		DoorUlocktmr
			clrf		chgtmrh
			clrf		chgtmrl
			bcf		Flags1,7
			bsf		Flags1,6
			bcf		Flags1,5
			goto		replyspl	


ckCMD6			nop
			movlw		CMD6		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD7
			movlw		EOP1
			xorwf		rxb_06,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_07,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		

			bsf		PORTE,2		
			movf		EE04,w
			movwf		led_status
			clrf		c_off_sec	
			movf		rxb_02,w
			movwf		chgtmrh
			movf		rxb_03,w
			movwf		chgtmrl
			bcf		Flags1,7
			bsf		Flags1,6
			bcf		Flags1,5
			goto		replyspl		

ckCMD7			nop
			movlw		CMD7		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD8
			movlw		EOP1
			xorwf		rxb_0E,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_0F,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f		
			btfss		STATUS,Z
			goto		CMDend		
			movf		rxb_02,w
			movwf		EE00
			movf		rxb_03,w
			movwf		EE01
			movf		rxb_04,w
			movwf		EE02
			movf		rxb_05,w
			movwf		EE03
			movf		rxb_06,w
			movwf		EE04
			movf		rxb_07,w
			movwf		EE05
			movf		rxb_08,w
			movwf		EE06
			movf		rxb_09,w
			movwf		EE07
			movf		rxb_0A,w
			movwf		EE08
			movf		rxb_0B,w
			movwf		EE09
			call		WRT_data
			goto		replyspl	
;
ckCMD8
			movlw		CMD8		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD9
			movlw		EOP1
			xorwf		rxb_04,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		
			nop
			movlw		0x67		
			movwf		last_cmd
			goto		replyspl	
;
ckCMD9			nop
			movlw		CMD9		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD10
			movlw		EOP1
			xorwf		rxb_04,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		
			nop
			bcf		PORTE,2		
			goto		replyspl		
;

ckCMD10			nop
			movlw		CMD10			
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD11
			movlw		EOP1
			xorwf		rxb_05,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_06,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f		 
			btfss		STATUS,Z
			goto		CMDend		
;
			nop
			movf		rxb_02,w
			movwf		cmd10_sec		
			call		unlock
			nop
			goto		replyspl

ckCMD11			nop
			movlw		CMD11			
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		ckCMD12
			movlw		EOP1
			xorwf		rxb_06,w
			btfss		STATUS,Z
			bsf		errflag,eop_err
			movlw		EOP2
			xorwf		rxb_07,w
			btfss		STATUS,Z
			bsf		errflag,eop_err

			movf		errflag,f	
			btfss		STATUS,Z
			goto		CMDend		

			movf		rxb_02,w
			movwf		Address_mask
			movf		rxb_03,w
;			movwf		EE0A
;			movf		EE0A,w
			movwf		EEDATA
			movlw		0x0A
			call		EE_write

			bcf		Flags1,7
			bsf		Flags1,6
			bcf		Flags1,5
			goto		replyspl	

ckCMD12			nop

CMDend			bcf		Flags,ReceivedCR	
			bcf		errflag,eop_err
			clrf		PacketTmr
			bra		MainLoop

;
Build_rply		nop

			call		BuildKeyBuf
			nop
;
;	CH rev2
;
			call		bld_crc		
			bsf		Flags1,0	
			nop
			bra			MainLoop
;
;
replyspl		nop	

rep_01			clrf		PacketTmr	
			btfsc		Flags1,0	
			goto		replysp2
			call		BuildTxBuf
;
;			
			movlw		CMD8		
			xorwf		rxb_01,w
			btfss		STATUS,Z
			goto		replysp4
			movlw		FW1		
			movwf		txb_05
			movlw		FW2		
			movwf		txb_06
			movlw		FW3			
			movwf		txb_07
;
replysp4		call		bld_crc		
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
			movlw		0x0C
			movwf		TxBytes
			movlw		SOP1	
			movwf		txb_00
			movlw		SOP2	
			movwf		txb_01
			movf		BD_loc,W
			movwf		txb_02
;
;	build reset of packet here
;
			movlw		0x05	
			movwf		txb_03
			movf		rxb_01,w
			movwf		txb_04
			call		bld_status
			movf		sys_status,w
			movwf		txb_05
			movf		Volt_L,w
			movwf		txb_06
			movf		sys_status2,w
			movwf		txb_07
			movlw		0x34	
			movwf		txb_08
			movlw		0x35	
			movwf		txb_09
			movlw		EOP1
			movwf		txb_0A
			movlw		EOP2
			movwf		txb_0B
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
;	get crc here
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
			nop
			return
;
PutRxBuf		nop
			movwf		POSTINC1
			decfsz		rxb_cnt
			bra		PutRx1
			nop
			bsf		Flags,ReceivedCR	

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
			movlw		IOA		
			movwf		TRISA

			movlw		IOB		
			movwf		TRISB
			movlw		IOC		
			movwf		TRISC
			movlw		IOD	
			movwf		TRISD
			movlw		IOE		
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

			movlw		0xFF
			movwf		Address_mask

			movlw		0x04
			movwf		Sum_cnt
			movlw		0xFF
			movwf		Sum_result_L
			movlw		chg_done_init
			movwf		chg_done

			bcf		PORTA,5		
			clrf		DoorUlocktmr
			clrf		PacketTmr
			clrf		txdly1
			clrf		rxb_cnt
			btfss		PORTB,2		
			return


PU_leds		equ	b'00000001'
			movlw	PU_leds
			movwf	EE00

LA_leds		equ	b'00000100'
			movlw	LA_leds
			movwf	EE01


RS_leds		equ	b'10000100'
			movlw	RS_leds
			movwf	EE02


DO_leds		equ	b'00001000'
			movlw	DO_leds
			movwf	EE03


CHG_leds	equ	b'00000000'
			movlw	CHG_leds
			movwf	EE04

CC_leds		equ	b'00000010'	
			movlw	CC_leds
			movwf	EE05

RF_leds		equ	b'10000010'
			movlw	RF_leds
			movwf	EE06

COFF_sec	equ	0x0A
		movlw	COFF_sec
		movwf	EE07

c_timeout_H	EQU	0x0E	
c_timeout_L	EQU	0x0A


			movlw	c_timeout_H	
			movwf	EE08		
			movlw	c_timeout_L
			movwf	EE09	


c_Address_mask	EQU	0xFF
			nop
			movlw	c_Address_mask
			movwf	EE0A	
			call	WRT_data
	
			return
;
bld_crc		movf		txb_03,w		
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
			movwf		wrk_c0
			movlw		0xFF		
			movwf		crc_hi
			movwf		crc_lo
			movf		BD_loc,w
			call		crc_ab
			lfsr		FSR0,rxb_00	
ck_crc1			movf		POSTINC0,w
			call		crc_ab		
			decfsz		wrk_c0
			bra		ck_crc1
			
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

;

current_V			nop
				movlw		b'00011110'
				movwf		ADCON1	

				movlw		b'00000001'	
				movwf		ADCON0		

;				movlw		b'00001101'	
				movlw		b'10001101'	
				movwf		ADCON2		
				nop
				movlw		d'05'		
				call		MSdly
;				call		SUdly
				nop
				bsf		ADCON0,1	
				nop
				nop
;				call		SUdly
				movlw		0x02
				call		MSdly	
				movf		ADRESH,w
				movwf		Volt_H
				movf		ADRESL,w
				movwf		Volt_L
				bcf		PORTD,3	
				
				return


;

I_avg			nop
			movf		Volt_H,w
			addwf		Sum_H
			movf		Volt_L,w
			addwf		Sum_L
			btfss		STATUS,C
			goto		I_sum1
			incf		Sum_H
I_sum1			decfsz		Sum_cnt
			goto		I_sum2
			movlw		0x04
			movwf		Sum_cnt
			nop				
			rrcf		Sum_H,f
			rrcf		Sum_L,f			; /2
			bcf		STATUS,C
			rrcf		Sum_H,f			; /2
			rrcf		Sum_L,f
			movf		Sum_L,w
			movwf		Sum_result_L
			movf		Sum_H,w
			movwf		Sum_result_H
			clrf		Sum_L
			clrf		Sum_H
			nop
I_sum2			nop
			return

WRT_data			nop			
				movf	EE00,w
				movwf	EEDATA
				movlw	0x00
				call	EE_write
				movf	EE01,w
				movwf	EEDATA
				movlw	0x01
				call	EE_write
				movf	EE02,w
				movwf	EEDATA
				movlw	0x02
				call	EE_write
				movf	EE03,w
				movwf	EEDATA
				movlw	0x03
				call	EE_write
				movf	EE04,w
				movwf	EEDATA
				movlw	0x04
				call	EE_write
				movf	EE05,w
				movwf	EEDATA
				movlw	0x05
				call	EE_write
				movf	EE06,w
				movwf	EEDATA
				movlw	0x06
				call	EE_write
				movf	EE07,w
				movwf	EEDATA
				movlw	0x07
				call	EE_write
				movf	EE08,w
				movwf	EEDATA
				movlw	0x08
				call	EE_write
				movf	EE09,w
				movwf	EEDATA
				movlw	0x09
				call	EE_write
				movf	EE0A,w
				movwf	EEDATA
				movlw	0x0A
				call	EE_write

				return
;
READ_data			nop
				movlw	0x00	
				call	EE_read
				movf	EEDATA,w
				movwf	EE00
				movlw	0x01
				call	EE_read
				movf	EEDATA,w
				movwf	EE01
				movlw	0x02
				call	EE_read
				movf	EEDATA,w
				movwf	EE02
				movlw	0x03
				call	EE_read
				movf	EEDATA,w
				movwf	EE03
				movlw	0x04
				call	EE_read
				movf	EEDATA,w
				movwf	EE04
				movlw	0x05
				call	EE_read
				movf	EEDATA,w
				movwf	EE05
				movlw	0x06
				call	EE_read
				movf	EEDATA,w
				movwf	EE06
				movlw	0x07
				call	EE_read
				movf	EEDATA,w
				movwf	EE07

				movlw	0x08	
				call	EE_read
				movf	EEDATA,w
				movwf	EE08

				movlw	0x09
				call	EE_read
				movf	EEDATA,w
				movwf	EE09

				movlw	0x0A
				call	EE_read
				movf	EEDATA,w
				movwf	EE0A

				return


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
				movlw	0x08		
				call	MSdly
				bcf	EECON1, WREN
				return


			END

