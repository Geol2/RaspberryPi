#include <SoftwareSerial.h>

#define RELAY_IN1 4
#define RELAY_IN2 5
#define RELAY_IN3 6
#define RELAY_IN4 7
#define fan1 11
#define fan2 12
#define fan3 13		//�ð��� �ɹ�ȣ

SoftwareSerial Serial_M(2, 3);	//�����ͺ���� ���

void Relay_Control(int cmd) {
	if (cmd == 4) {
		for (int i = RELAY_IN1; i <= RELAY_IN4; i++)
			digitalWrite(i, LOW);
	}
	else if (cmd == 5) {
		for (int i = RELAY_IN1; i <= RELAY_IN4; i++)
			digitalWrite(i, HIGH);
	}
}

void fan_control(int cmd) {
	if (cmd == 8) {
		digitalWrite(fan1, HIGH);
		digitalWrite(fan2, HIGH);
		digitalWrite(fan3, HIGH);

	}
	else if (cmd == 9) {
		digitalWrite(fan1, LOW);
		digitalWrite(fan2, LOW);
		digitalWrite(fan3, LOW);
	}
}

void setup()
{
	Serial.begin(9600);		//�����̺� ����� ���
	Serial_M.begin(9600);	//�����ͺ� ����� ���
	pinMode(fan1, OUTPUT);
	pinMode(fan2, OUTPUT);
	pinMode(fan3, OUTPUT);		//�ð��� �ɸ�� : ���
	pinMode(RELAY_IN1, OUTPUT);
	pinMode(RELAY_IN2, OUTPUT);
	pinMode(RELAY_IN3, OUTPUT);
	pinMode(RELAY_IN4, OUTPUT);			//LED����� ������ �ɸ��.
	for (int i = RELAY_IN1; i <= RELAY_IN4; i++) {
		digitalWrite(i, HIGH);
	}
	digitalWrite(fan1, LOW);
	digitalWrite(fan2, LOW);
	digitalWrite(fan3, LOW);
}

void loop()
{
	if (Serial.available()) {		//�����̺� ���忡�� ������ ������ ������ ���
		int cmd = Serial.parseInt();
		switch (cmd) {
		case 4:			//LED ON
			Relay_Control(4);
			break;
		case 5:			//LED OFF
			Relay_Control(5);
			break;
		case 8:			//FAN ON
			fan_control(8);
			break;
		case 9:			//FAN OFF
			fan_control(9);
			break;
		}
	}
}

