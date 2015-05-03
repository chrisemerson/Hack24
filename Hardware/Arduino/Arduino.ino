/*
 * Required Arduino Libraries
 */

#include <SparkFunColorLCDShield.h>
#include <Adafruit_NeoPixel.h>
#include <TaskAction.h>

/*
 * Local Application Headers
 */

#include "lcd_controller.h"
#include "button.h"

#define NUM_EFFECTS 3

static volatile uint8_t s_nextByte;
static volatile bool s_byteReady = false;

static Adafruit_NeoPixel s_strip = Adafruit_NeoPixel(60, 6, NEO_GRB + NEO_KHZ800);

static BTN s_btn = {
	BTN_STATE_INACTIVE,
	onButtonPress,
	NULL,
	0,
	0,
	0,
	10
};

void btnTaskFn(void)
{
	BTN_Update(&s_btn, digitalRead(5) == HIGH ? BTN_STATE_INACTIVE : BTN_STATE_ACTIVE);
}
TaskAction btnTask(btnTaskFn, 10, INFINITE_TICKS);

void onButtonPress(BTN_STATE_ENUM btnState)
{
	Serial.print('0');
}

void handleSerial(char nextByte)
{
	Serial.print(nextByte);
	static uint8_t nextColour = 0;
	static uint16_t colours[3];

	colours[nextColour++] = nextByte;

	if (nextColour == 3)
	{
		nextColour = 0;

		colorWipe(s_strip.Color(colours[0], colours[1], colours[2]), 50);
	}
}

void setup(void)
{
	Serial.begin(115200);
	
	s_strip.begin();
  	s_strip.show();

  	pinMode(5, INPUT_PULLUP);

  	if (!BTN_InitHandler(&s_btn))
  	{
  		Serial.println("Button not initialised.");
  	}
}

void loop(void)
{
	if (s_byteReady)
	{
		s_byteReady = false;
		handleSerial(s_nextByte);
	}

	btnTask.tick();
}

void serialEvent(void)
{
	if (Serial.available())
	{
		s_nextByte = Serial.read();
		s_byteReady = true;
	}
}

// Fill the dots one after the other with a color
void colorWipe(uint32_t c, uint8_t wait) {
  for(uint16_t i=0; i<s_strip.numPixels(); i++) {
      s_strip.setPixelColor(i, c);
      s_strip.show();
      delay(wait);
  }
}

void rainbow(uint8_t wait) {
  uint16_t i, j;

  for(j=0; j<256; j++) {
    for(i=0; i<s_strip.numPixels(); i++) {
      s_strip.setPixelColor(i, Wheel((i+j) & 255));
    }
    s_strip.show();
    delay(wait);
  }
}

// Slightly different, this makes the rainbow equally distributed throughout
void rainbowCycle(uint8_t wait) {
  uint16_t i, j;

  for(j=0; j<256*5; j++) { // 5 cycles of all colors on wheel
    for(i=0; i< s_strip.numPixels(); i++) {
      s_strip.setPixelColor(i, Wheel(((i * 256 / s_strip.numPixels()) + j) & 255));
    }
    s_strip.show();
    delay(wait);
  }
}

//Theatre-style crawling lights.
void theaterChase(uint32_t c, uint8_t wait) {
  for (int j=0; j<10; j++) {  //do 10 cycles of chasing
    for (int q=0; q < 3; q++) {
      for (int i=0; i < s_strip.numPixels(); i=i+3) {
        s_strip.setPixelColor(i+q, c);    //turn every third pixel on
      }
      s_strip.show();
     
      delay(wait);
     
      for (int i=0; i < s_strip.numPixels(); i=i+3) {
        s_strip.setPixelColor(i+q, 0);        //turn every third pixel off
      }
    }
  }
}

//Theatre-style crawling lights with rainbow effect
void theaterChaseRainbow(uint8_t wait) {
  for (int j=0; j < 256; j++) {     // cycle all 256 colors in the wheel
    for (int q=0; q < 3; q++) {
        for (int i=0; i < s_strip.numPixels(); i=i+3) {
          s_strip.setPixelColor(i+q, Wheel( (i+j) % 255));    //turn every third pixel on
        }
        s_strip.show();
       
        delay(wait);
       
        for (int i=0; i < s_strip.numPixels(); i=i+3) {
          s_strip.setPixelColor(i+q, 0);        //turn every third pixel off
        }
    }
  }
}

// Input a value 0 to 255 to get a color value.
// The colours are a transition r - g - b - back to r.
uint32_t Wheel(byte WheelPos) {
  WheelPos = 255 - WheelPos;
  if(WheelPos < 85) {
   return s_strip.Color(255 - WheelPos * 3, 0, WheelPos * 3);
  } else if(WheelPos < 170) {
    WheelPos -= 85;
   return s_strip.Color(0, WheelPos * 3, 255 - WheelPos * 3);
  } else {
   WheelPos -= 170;
   return s_strip.Color(WheelPos * 3, 255 - WheelPos * 3, 0);
  }
}
