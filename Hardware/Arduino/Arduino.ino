/*
 * Required Arduino Libraries
 */

#include <SparkFunColorLCDShield.h>

/*
 * Local Application Headers
 */

#include "lcd_controller.h"

enum state
{
	STATE_IDLE,
	STATE_BITMAP
};
typedef enum state STATE;

enum event
{
	EVENT_RECV_BITMAP
};
typedef enum event EVENT;

static STATE s_state = STATE_IDLE;

void handleSerial(char nextByte)
{
	switch (s_state)
	{
	case STATE_IDLE:
		handleIdleSerial(nextByte);
		break;
	case STATE_BITMAP:
		handleBitmapSerial(nextByte);
		break;
	default:
		break;
	}
}

void handleIdleSerial(char nextByte)
{
	switch ((EVENT)nextByte)
	{
	case EVENT_RECV_BITMAP:
		s_state = STATE_BITMAP;
		break;
	default:
		break;
	}
}

void handleBitmapSerial(char nextByte)
{
	static bool lowerByte = true;
	static int colour = 0;

	if (lowerByte)
	{
		colour = (int)(nextByte & 0xFF);
		lowerByte = false;
	}
	else
	{
		colour |= (int)(nextByte & 0x0F);
		LCD_SetNextBitmapPixel(colour);
		colour = 0;
		lowerByte = true;
	}

	if (LCD_BitmapComplete())
	{
		s_state = STATE_IDLE;
	}
}

void setup(void)
{
	Serial.begin(115200);
	LCD_setup();
	LCD_ResetBitmap();
}

void loop(void)
{
	
}

void serialEvent(void)
{
	while (Serial.available())
	{
		handleSerial(Serial.read());
	}
}
