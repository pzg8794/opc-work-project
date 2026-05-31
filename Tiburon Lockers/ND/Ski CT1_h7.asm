;
;=============================================================================
;	Filename:	Tiburon rev 5a.asm
;=============================================================================
;	Author: 	C. Hentschel
;	Company:	UplandCompany
;	Revision:	3.00
;	Date:		Oct 13, 2007
;	Assembled using MPLAB IDE v7.62
;=============================================================================


		list p=18f4520		;list directive to define processor
		#include <p18f4520.inc>	;processor specific definitions


;#define UDEV_CODE 1        
;#define EMU_DBG 1             
;#define ICD_DBG 1            


;/*-----------------------------*/
;/*   mpasm / processor setup   */
;/*-----------------------------*/

        CONFIG  OSC = HS, IESO = OFF           
        CONFIG  BOREN = OFF, PWRT = OFF        
        CONFIG  CCP2MX = PORTC                 
        CONFIG  STVREN = ON, LVP = OFF         
        CONFIG  PBADEN = OFF                   
        CONFIG  WDTPS = 512                    
        CONFIG  EBTRB=OFF                      

    IFDEF ICD_DBG
        CONFIG  DEBUG=ON                       
        CONFIG  WDT=OFF                        
        CONFIG  CP0=OFF, CP1=OFF, CP2=OFF, CP3=OFF  
        CONFIG  CPB=OFF, CPD=OFF                    
        CONFIG  WRT0=OFF, WRT1=OFF, WRT2=OFF, WRT3=OFF 
        CONFIG  WRTB=OFF, WRTC=OFF, WRTD=OFF           
        CONFIG  EBTR0=OFF, EBTR1=OFF, EBTR2=OFF, EBTR3=OFF 
    ELSE
        CONFIG  DEBUG=OFF
        CONFIG  WDT=ON
        CONFIG  CP0=ON, CP1=ON, CP2=ON, CP3=ON          
        CONFIG  CPB=ON, CPD=ON                          
        CONFIG  WRT0=ON, WRT1=ON, WRT2=ON, WRT3=ON      
        CONFIG  WRTB=ON, WRTC=ON, WRTD=ON               
        CONFIG  EBTR0=ON, EBTR1=ON, EBTR2=ON, EBTR3=ON  
    ENDIF

SPBRG_VAL	EQU	.23			
TX_BUF_LEN	EQU	.25			
RX_BUF_LEN	EQU	TX_BUF_LEN	
SOP1		EQU	0x7E		
SOP2		EQU	0x1B		
EOP1		EQU	0x81		
EOP2		EQU	0xE4		
PacketDly	EQU	0x40		
TxDly		EQU	0x08		
FW1		EQU	0x35		; 5
FW2		EQU	0x41		; A
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
CMDTST	EQU	0xF1		
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
Door_time	EQU	3	
;

		CBLOCK	0x000
		begin_ram
		WREG_TEMP		
		STATUS_TEMP		
		BSR_TEMP		
		FSR0H_TEMP		
		FSR0L_TEMP		
		FSR0H_SHADOW	
		FSR0L_SHADOW	
		Flags			

		errflag		

		TempData		
		TempRxData		
		TempTxData		
		TxStartPtrH		
		TxStartPtrL		
		TxEndPtrH		
		TxEndPtrL		
		RxStartPtrH		
		RxStartPtrL		
		RxEndPtrH		
		RxEndPtrL		
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
		status		
		TxBytes		
		crc_lo		
		crc_hi		
		BD_loc		
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
		Door_debounce	
		

		TxBuffer:TX_BUF_LEN	
		RxBuffer:RX_BUF_LEN	
		ram_end

		ENDC

IOA	equ	B'00001110'	; porta

IOB	equ	B'00110001'	; portb

IOC	equ	B'10110001'	; portc

IOD	equ	B'11111111'	; portd


IOE	equ	B'00000000'	; porte

		ORG     0x0000		

  ResetVector:	bra	Main	


		ORG	0x0008

HighInt:		bra		HighIntCode	


		ORG	0x0018

LowInt:			movff		STATUS,STATUS_TEMP	
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
				movwf 	txdly1
				rcall		GetTxBuf
				movwf		TXREG		

EndLowInt:			movff		FSR0L_TEMP,FSR0L	
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



HighInt1:			reset			

.

GetData:			btfsc		RCSTA,OERR	
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

CkSOP1				btfsc		Flags,StartPkt	
				bra		CkSOP2	
				movf		RCREG,W				
				movwf		PacketTemp,W
				xorlw		SOP1
				btfsc		STATUS,Z		
				bsf		Flags,StartPkt
				bra		GetData1	
	
CkSOP2				btfsc		Flags,StartPkt2	
				bra		CkAddr
				movf		RCREG,W		
				movwf		PacketTemp	
				xorlw		SOP2			
				btfsc		STATUS,Z	
				bsf		Flags,StartPkt2
				bra		GetData1		

CkAddr				movf		RCREG,W		
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
CkAddrFG			movf		RCREG,W		
				movwf		PacketTemp		
				movlw		BC_address
;				movlw		0xFF			
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
;	
GetData2			movf		RCREG,W			
				movf		rxb_cnt,f
				btfss		STATUS,Z		
				bra		GetD3
				movwf		rxb_cnt	
				movlw		0x04
				addwf		rxb_cnt,1		
				lfsr		FSR1,rxb_00	

GetD3				nop
				movf		RCREG,W		
				rcall		PutRxBuf
GetData1			nop
				bra		EndHighInt



ErrOERR:			bcf		RCSTA,CREN	
				bsf		RCSTA,CREN	
				bra		EndHighInt


ErrFERR:			movf		RCREG,W	
				bra		EndHighInt


ErrRxOver:			movf		RCREG,W		
				xorlw		0x0d				
				btfsc		STATUS,Z		
				bsf		Flags,ReceivedCR 
				bra		EndHighInt



EndHighInt:			movff		FSR0L_SHADOW,FSR0L	
				movff		FSR0H_SHADOW,FSR0H	
				retfie	FAST			

;

StartSig			movlw		0x04
				movwf		temp2
SSlp1				bsf			PORTB,1
				call		SUdly
				bcf			PORTB,1
				bsf			PORTB,2
				call		SUdly
				bcf			PORTB,2
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
;	500 uSec delay routine 
;
dly1			movlw		0x01	
				movwf		tdly2
				goto		dly2a
dly2			movlw		0x7F		
				movwf		tdly2
dly2a			nop
				nop
x				nop
				nop
				decfsz		tdly2,f
				goto		dly2a
				return



Dataxfer		btfsc	PORTC,0		
				goto	xfer_end
				nop
				bcf		PORTC,3	
				movlw	0x5A
				movwf	dataout1
				movwf	dataout3
				movwf	dataout5
				movwf	dataout7
				movlw	0xA5
				movwf	dataout2
				movwf	dataout4
				movwf	dataout6
				movwf	dataout8
				movlw	0x40
				movwf	xfercnt
				bcf		PORTC,3

xfer1			nop
				bsf		PORTA,0
				rrcf	dataout1
				rrcf	dataout2
				rrcf	dataout3
				rrcf	dataout4
				rrcf	dataout5
				rrcf	dataout6
				rrcf	dataout7
				rrcf	dataout8
				btfss	STATUS,C
				bcf		PORTA,0
				
				bcf		STATUS,C
				btfsc	PORTA,1		
				bsf		STATUS,C
				rrcf	datain1
				rrcf	datain2
				rrcf	datain3
				rrcf	datain4
				rrcf	datain5
				rrcf	datain6
				rrcf	datain7
				rrcf	datain8
				
				bsf		PORTC,3	
				call	dly1
				nop
				bcf		PORTC,3	

				call	dly1
				decfsz xfercnt
				goto	xfer1
xfer_end				nop
				return

;

Main:				nop
				call		Initcode
Main_dly			nop			
				clrwdt		
				movf		PORTD,w
				movwf		temp2
				andlw		0x0F
				movwf		temp2
				swapf		temp2
m_dly1				call		SUdly
				decfsz		temp2
				goto		m_dly1
				nop

				movlw		0x20
				movwf		Rent_stat
				call		StartSig
;

MainLoop:			nop
				clrwdt
				call	Dataxfer

				movf		datain5,f 
				btfsc		STATUS,Z
				goto		tst1
				movf		datain6,w
				movwf		Door_loc	
				movf		datain7,w
				movwf		Door_ult	
				clrf		datain5
				nop
				goto		Build_rply	
				nop
tst1			nop
;


				movf		PORTD,w
				movwf		BD_loc

ck_avail		btfss		Rent_stat,0	
				goto		ck_wait
				bsf			PORTB,2	
				bcf			PORTB,1
				goto		ck_end
ck_wait			btfss		Rent_stat,1		
				goto		ck_rented
				btfss		toggle,1
				bsf		PORTB,2
				btfsc		toggle,1
				bcf		PORTB,2
				bcf		PORTB,1	
				goto		ck_end
ck_rented			btfss		Rent_stat,2	
				goto		ck_clean
				bcf		PORTB,2	
				bsf		PORTB,1
				goto		ck_end
;
;
ck_clean			btfss		Rent_stat,3		
				goto		ck_clb
				btfss		toggle,2
				goto		ck_c1
				bsf		PORTB,2		
				bcf		PORTB,1
				goto		ck_end
ck_c1				bcf		PORTB,2		; red led on
				bsf		PORTB,1
				goto		ck_end			

ck_clb			btfss		Rent_stat,4		
				goto		ck_reset
				bcf		PORTB,1
				bcf		PORTB,2
				goto		ck_end

ck_reset			btfss		Rent_stat,5		
				goto		ck_unlock
				bcf		PORTB,2
				movlw		b'00011111'
				andwf		toggle,w
				xorlw		b'00010001'
				btfss		STATUS,Z
				goto		ck_end
				bsf		PORTB,2
				goto 		ck_end
ck_unlock			btfss		Rent_stat,6	
				goto		ck_clean2
				movlw		b'00000111'
				andwf		toggle,w
				xorlw		b'00000001'
				btfss		STATUS,Z
				goto		ck_r1
				bsf		PORTB,1
				goto 		ck_end

ck_clean2			btfss		Rent_stat,7		
				goto		ck_r1

				bcf		PORTB,2
				bcf		PORTB,1		; turn off RED led

				movlw		b'00001110'
				andwf		toggle,w
				xorlw		b'00000100'
				btfsc		STATUS,Z
				goto		setred

				movlw		b'00001110'
				andwf		toggle,w
				xorlw		b'00001000'
				btfsc		STATUS,Z
				goto		setgrn

				movlw		b'00001110'
				andwf		toggle,w
				xorlw		b'00001010'
				btfsc		STATUS,Z
				goto		setbth

				goto		ck_end
			

setred			bsf		PORTB,1
				bcf		PORTB,2
				goto		ck_end

setgrn			bsf		PORTB,2
				bcf		PORTB,1
				goto		ck_end

setbth			bsf		PORTB,2
				bsf		PORTB,1
				goto		ck_end


ck_r1				bcf		PORTB,2
				bcf		PORTB,1	
				
				goto		ck_end
ck_end			nop

Motor_on_cntU	equ	0x04
Motor_off_cntU	equ	0x08
Motor_on_cntL	equ	0x01
Motor_off_cntL	equ	0x08
;
				btfss		Motor_stat,0
				goto		ds0
				movlw		Motor_on_cntU
				movwf		Motor_on_cnt
				movlw		Motor_off_cntU
				movwf		Motor_off_cnt
;
ds0				btfss		Motor_stat,1
				goto		ds1
				movlw		Motor_on_cntL
				movwf		Motor_on_cnt
				movlw		Motor_off_cntL
				movwf		Motor_off_cnt
;
ds1				nop
				incf		Motor_duty,f
				movf		Motor_stat,w
				andlw		0x03
				btfsc		STATUS,Z
				goto		mdc1

				btfss		PORTC,2
				goto		mdc0		
				movf		Motor_duty,w
				xorwf		Motor_on_cnt	
				btfss		STATUS,Z
				goto		mdc2
				bcf		PORTC,2
				clrf		Motor_duty
mdc0				nop
				movf		Motor_duty,w
				xorwf		Motor_off_cnt	
				btfss		STATUS,Z
				goto		mdc2
				bsf		PORTC,2	
				clrf		Motor_duty
				goto		mdc2
				nop
mdc1				bcf		PORTC,2		
				clrf		Motor_duty
mdc2				nop
				nop
				btfss		PORTC,4			
				bcf		Motor_stat,0		

				nop
				btfsc		PORTC,4		
				bcf		Motor_stat,1	


				btfsc		PORTA,2
				goto		dp1			

				nop
				btfsc		Motor_stat,3	
				goto		dp1

				btfsc		Rent_stat,7
				goto		dp01

				btfss		Rent_stat,1		     
                        goto		dp2			
dp01				movlw		0x04
				movwf		Rent_stat		
				clrf		DoorUlocktmrh	
				clrf		DoorUlocktmrl		

dp1				btfss		PORTA,2
				goto		dp2
				nop
				btfsc		Motor_stat,3		
				goto		dp2
				movf		DoorUlocktmrh,f
				btfss		STATUS,Z		
				goto		dp2				
				movf		DoorUlocktmrl,f	
				btfss		STATUS,Z
				goto		dp2
;
				btfss		PORTC,4		
				bsf		Motor_stat,1	
dp2				nop


				call		dly2
				decfsz	sec_lo
				goto		ML3
				movlw		.200		
				movwf		sec_lo
				incf		toggle,f	
				decfsz	sec_hi
				goto		ML3
				movlw		.10			
				movwf		sec_hi

				movf		DoorUlocktmrh,f
				btfss		STATUS,Z		
				goto		MLt1				
				movf		DoorUlocktmrl,f		
				btfsc		STATUS,Z
				goto		ML3			
;
MLt1				nop

;
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


;ML2
				bcf		PORTB,1		
				bcf		PORTB,2			
				bsf		Motor_stat,1	
				movf		LRent_stat,w
				movwf		Rent_stat		

ML2				nop

;
ML3				nop
				movf		PacketTmr,f
				btfsc		STATUS,Z
				bra		Tmrrtn
				call		dly2
				decfsz	PacketTmr,f
				bra		Tmrrtn1
Tmrrtn			nop
				clrf		rxb_cnt		
Tmrrtn1			nop
;
;
				btfss		Flags,ReceivedCR 	
;
				goto		MainLoop1


chtest			nop
				call		ck_crc		
				addlw		0x00
				btfsc		STATUS,Z
				goto		ckCMD00
				goto		ckBCMDend

ckCMD00			btfss		rxb_01,7		
				goto		ckCMD0		
				swapf		BD_loc,w		
				andlw		0x0F			
				xorwf		rxb_04
				btfss		STATUS,Z
				goto		ckBCMDend		
				nop
				movf		BD_loc,w
				andlw		0x0F			
				movwf		temp1	
bcmdlp			bcf		STATUS,C
				RRCF		rxb_05
				RRCF		rxb_06
				movf		temp1,f		
				btfsc		STATUS,Z
				goto		bcmdlp1		
				decfsz	temp1
				goto		bcmdlp
bcmdlp1			btfss		STATUS,C
				goto		ckBCMDend
				goto		ckBCMDA		
				nop
;
				movlw		BCMD1	
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckBCMD2					
				
		
ckBCMD2			nop
ckBCMDend			bcf		Flags,ReceivedCR
				bcf		Motor_stat,7		
				goto		MainLoop		
;
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
				goto		ckCMDend				

				movf		rxb_02,w
				btfsc		STATUS,Z
				goto		ckCMDend				
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
				goto		ckCMDend

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
				goto		ckCMDend
				nop
ckCMD3			movlw		CMD3	
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMD4
				call		BuildVerBuf
				goto		replyspl
ckCMD4			movlw		CMD4					
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMD5
				movlw		EOP1
				xorwf		rxb_04
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_05
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		0x01
				movwf		Rent_stat				
				goto		ckCMDend
				nop
ckCMD5			movlw		CMD5					
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMD6
				movlw		EOP1
				xorwf		rxb_04
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_05
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		0x04
				movwf		Rent_stat					
				goto		ckCMDend
				nop
ckCMD6			movlw		CMD6						
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMD7
				movlw		EOP1
				xorwf		rxb_04
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_05
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		0x08
				movwf		Rent_stat				
				goto		ckCMDend
				nop
ckCMD7			movlw		CMD7						
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMD8
				movlw		EOP1
				xorwf		rxb_04
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_05
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		0x10
				movwf		Rent_stat				
				goto		ckCMDend
				nop
				nop
ckCMD8			nop
				movlw		CMD8					
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMD9
		
				movlw		EOP1
				xorwf		rxb_07
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_08
				btfss		STATUS,Z
				bsf		errflag,eop_err

				movf		errflag,f				
				btfss		STATUS,Z
				goto		ckCMDend				

				movf		rxb_02,w				
				iorwf		rxb_03,w
				btfsc		STATUS,Z
				goto		ckCMDend

				movf		rxb_02,w
				movwf		DoorUlocktmrl			
				movf		rxb_03,w
				movwf		DoorUlocktmrh
				movf		rxb_04,w				
				movwf		LRent_stat				
				movlw		0x02
				movwf		Rent_stat				
				clrf		Motor_stat
				bsf		Motor_stat,0			
				nop
				goto		ckCMDend
; 
ckCMD9			movlw		CMD9						
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMDA
				movlw		EOP1
				xorwf		rxb_04
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_05
				btfss		STATUS,Z
				bsf		errflag,eop_err
				clrf		Motor_stat
				bsf		Motor_stat,0
				bsf		Motor_stat,3			
				movlw		0x40
				movwf		Rent_stat				
				goto		ckCMDend	
				nop

ckCMDA			movlw		CMDA					
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMDB
				nop
				movlw		EOP1
				xorwf		rxb_07
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_08
				btfss		STATUS,Z
				bsf		errflag,eop_err

				movf		errflag,f				
				btfss		STATUS,Z
				goto		ckCMDend				
				goto		ckCMDA1				

ckBCMDA			movlw		EOP1					
				xorwf		rxb_09				
				btfss		STATUS,Z
				bsf		errflag,eop_err
				movlw		EOP2
				xorwf		rxb_0A
				btfss		STATUS,Z
				bsf		errflag,eop_err

				movf		errflag,f				
				btfss		STATUS,Z
				goto		ckCMDend				


ckCMDA1			movf		rxb_02,w				
				iorwf		rxb_03,w
				btfsc		STATUS,Z
				goto		ckCMDend

				movf		rxb_02,w
				movwf		DoorUlocktmrl			
				movf		rxb_03,w
				movwf		DoorUlocktmrh

				movf		Rent_stat,w				
				movwf		LRent_stat				
				movlw		0x80
				movwf		Rent_stat				
											
				movlw		0x80
				andwf		Motor_stat,f			
				bsf		Motor_stat,0			
				nop
				btfss		Motor_stat,7					
				goto		ckCMDend
				bcf		Motor_stat,7			
				bcf		Flags,ReceivedCR			
				goto		MainLoop2				
; 
ckCMDB			movlw		CMDB					
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMDTST
				nop
ckCMDTST			movlw		CMDTST
				xorwf		rxb_01,w
				btfss		STATUS,Z
				goto		ckCMD_un
				bsf		errflag,7
				bsf		errflag,6
				call		BuildErrBuf					
				goto		replyspl
ckCMD_un			bsf		errflag,un_cmd
ckCMDend			nop


Build_rply		nop
				call		BuildUlockBuf
				nop

				call		bld_crc				
				nop
;
;

replyspl		clrf		PacketTmr		
				call		dly2
				bsf			PORTA,5			
				call		dly2			
				movlw		TxDly
				movwf		txdly1
				call		dly2
				nop
				bcf			Flags,ReceivedCR
				bcf			Flags,TxBufEmpty 	
				bsf			PIE1,TXIE			

;		
MainLoop1		nop
				movf		txdly1,f
				btfss		STATUS,Z
				decf		txdly1,f
				movf		txdly1,f
				btfsc		STATUS,Z
MainLoop2		bcf			PORTA,5			
				bsf			PIE1,RCIE		
				nop
;
;
tx_dly			movlw		0x10
				movwf		temp3
tx_dly1			call		SUdly				
				decfsz		temp3
				goto		tx_dly1
				nop

				bra			MainLoop		


BuildTxBuf		nop
				movlw		0x0A
				movwf		TxBytes
				movlw		SOP1			
				movwf		txb_00
				movlw		SOP2			
				movwf		txb_01
				movf		BD_loc,W
				movwf		txb_02

				movlw		0x03			
				movwf		txb_03
				movf		rxb_01,w		
				movwf		txb_04

				movf		errflag,f
				btfsc		STATUS,Z
				goto		Btx1
				bsf			errflag,7
				movf		errflag,w
				movwf		txb_04

Btx1			Call		StatusI			
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
				return
;

;
BuildUlockBuf	nop
				movlw		0x0A
				movwf		TxBytes
				movlw		SOP1			
				movwf		txb_00
				movlw		SOP2			
				movwf		txb_01
				movf		Door_loc,W
				movwf		txb_02

				movlw		0x03			
				movwf		txb_03
				movlw		0x01			
				movwf		txb_04

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
				return
;

BuildErrBuf		nop
				movlw		0x0A
				movwf		TxBytes
				movf		rxb_02,w		
				movwf		txb_00
				movf		rxb_03,w		
				movwf		txb_01
				movf		BD_loc,W
				movwf		txb_02

				movf		rxb_04,w		
				movwf		txb_03

				movf		errflag,w			
				movwf		txb_04
;	get crc here
;
				call		StatusI			
				movwf		txb_05
				movf		rxb_05,w		
				movwf		txb_06
				movf		rxb_06,w			
				movwf		txb_07
				movf		rxb_07,w
				movwf		txb_08
				movf		rxb_08,w
				movwf		txb_09
				lfsr		FSR1,txb_00		
				clrf		errflag			
				return

BuildVerBuf		nop
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
				movlw		FW1 			
				movwf		txb_04
;
;
				movlw		FW2
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
				return

GetTxBuf			movlw		TxDly	
				movwf		txdly1			
				movf		POSTINC1,w
				nop
				decfsz	TxBytes
				return
				bsf		Flags,TxBufEmpty

				nop
				return

PutRxBuf			nop
				movwf		POSTINC1
				decfsz	rxb_cnt
				bra		PutRx1
				nop
				bsf		Flags,ReceivedCR	
;				call		BuildTxBuf
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
clr_reg1			clrf		POSTINC0
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


;
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
				bra			bld_crc1

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
				btfsc		Motor_stat,7
				movlw		BC_address
;				movlw		0xFF
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

