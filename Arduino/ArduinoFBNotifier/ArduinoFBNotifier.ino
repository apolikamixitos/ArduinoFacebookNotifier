
String Datain="";

//Number of unread friend requests, unseen messages and unseen notifications
int NBRFREQ = 0;
int NBRMSGS = 0;
int NBRNOTIF = 0;

//PINS
int FREQPIN=8;
int MSGSPIN=10;
int NOTIFPIN=12;

//PINS STATES (for simultanous blinking)
int FREQPINSTATE=LOW;
int MSGSPINSTATE=LOW;
int NOTIFPINSTATE=LOW;

//Next change state (Milliseconds for next state change)
long FREQPINCHANGE=0;
long MSGSPINCHANGE=0;
long NOTIFPINCHANGE=0;

//Delay of blinking (relative to number of requests NBRFREQ, NBRMSGS and NBRNOTIF)
int FREQPINDELAY=2000;
int MSGSPINDELAY=2000;
int NOTIFPINDELAY=2000;




void setup() {
	pinMode(FREQPIN, OUTPUT);
        pinMode(MSGSPIN, OUTPUT);
        pinMode(NOTIFPIN, OUTPUT);
	Serial.begin(9600);    // opens serial port, sets data rate to 9600 bps
}

void loop() {
	
	if(Serial.available()){
		while (Serial.available()) {
			char T = (char)Serial.read();
			Datain += T;
			
			if(T=='\n'){
				//Serial.print("I received: ");
				//Serial.println(Datain);
                                UpdateNumbers(Datain);
                                //Serial.println("FREQ:"+NBRFREQ);                               
				Datain="";
			}
			
		}
		}else{ 
  
      		BlinkFREQ();
      		BlinkMSGS();
         	BlinkNOTIF();
	}
}

void BlinkFREQ(){
  // this if-statement will not execute for another 'FREQPINDELAY' milliseconds
  if(NBRFREQ>0){
    if (millis() >= FREQPINCHANGE) {
      FREQPINSTATE = !(FREQPINSTATE);
      FREQPINCHANGE  += (FREQPINDELAY/NBRFREQ);
      digitalWrite(FREQPIN, FREQPINSTATE);
   }
  }else
      digitalWrite(FREQPIN, LOW);
}

void BlinkMSGS(){
  // this if-statement will not execute for another 'MSGSPINDELAY' milliseconds
  if(NBRMSGS>0){
    if (millis() >= MSGSPINCHANGE) {
      MSGSPINSTATE = !(MSGSPINSTATE);
      MSGSPINCHANGE  += (MSGSPINDELAY/NBRMSGS);
      digitalWrite(MSGSPIN, MSGSPINSTATE
   }
  }else
      digitalWrite(MSGSPIN, LOW);
}

void BlinkNOTIF(){
  // this if-statement will not execute for another 'NOTIFPINDELAY' milliseconds
  if(NBRNOTIF>0){
    if (millis() >= NOTIFPINCHANGE) {
      NOTIFPINSTATE = !(NOTIFPINSTATE);
      NOTIFPINCHANGE  += (NOTIFPINDELAY/NBRNOTIF);
      digitalWrite(NOTIFPIN, NOTIFPINSTATE);
   }
  }else
      digitalWrite(NOTIFPIN, LOW);
}


void  UpdateNumbers(String Inst){
	Inst.trim();
	int Ind;
	Ind = Inst.indexOf("FREQ");
	if(Ind>=0){
                //Ex: Instruction 'FREQ:12' (with 12 number of friendrequests)
                //5 = 4 (for the word 'FREQ') + 1 (for the char ':')
		NBRFREQ = Inst.substring(Ind+5).toInt();
		}else{
		Ind = Inst.indexOf("MSGS");
		if(Ind>=0){
                        //Ex: Instruction 'MSGS:12' (with 12 number of messages)
                        //5 = 4 (for the word 'MSGS') + 1 (for the char ':')
			NBRMSGS = Inst.substring(Ind+5).toInt();
			}else{
			Ind = Inst.indexOf("NOTIF");
			if(Ind>=0){
                                //Ex: Instruction 'NOTIF:12' (with 12 number of notifications)
                                //6 = 5 (for the word 'NOTIF') + 1 (for the char ':')
				NBRNOTIF = Inst.substring(Ind+6).toInt();
			}
		}
	}
	
}
