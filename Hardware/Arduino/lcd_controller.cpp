/*
  TestPattern - An example sketch for the SparkFun Color LCD Shield Library
  by: Jim Lindblom
  SparkFun Electronics
  date: 6/23/11
  license: CC-BY SA 3.0 - Creative commons share-alike 3.0
  use this code however you'd like, just keep this license and
  attribute. Let me know if you make hugely, awesome, great changes.

  This sketch has example usage of the Color LCD Shield's three
  buttons. It also shows how to use the setRect and contrast
  functions.
  
  Hit S1 to increase the contrast, S2 decreases the contrast, and
  S3 sets the contrast back to the middle.
*/

#include <Arduino.h>
#include <SparkFunColorLCDShield.h>

#include "lcd_controller.h"
#include "button.h"


#define BUTTON1_PIN 3
#define BUTTON2_PIN 4
#define BUTTON3_PIN 5

#define BEST_CONTRAST -70

static LCDShield s_lcd;

//static uint8_t s_buttonPins[] = {BUTTON1_PIN, BUTTON2_PIN, BUTTON3_PIN};

static void initButton(uint8_t btn)
{
    //BTN_InitHandler(s_buttons[btn]);
    //pinMode(s_buttonPins[btn], INPUT);  // Set buttons as inputs
    //digitalWrite(s_buttonPins[btn], HIGH);  // Activate internal pull-up
}

static void updateButtons(void)
{
  //BTN_Update(s_buttons[0], digitalRead(s_buttonPins[0]) == LOW ? BTN_STATE_ACTIVE : BTN_STATE_INACTIVE);
  //BTN_Update(s_buttons[1], digitalRead(s_buttonPins[1]) == LOW ? BTN_STATE_ACTIVE : BTN_STATE_INACTIVE);
  //BTN_Update(s_buttons[2], digitalRead(s_buttonPins[2]) == LOW ? BTN_STATE_ACTIVE : BTN_STATE_INACTIVE);
}

void LCD_setup(void)
{
  uint8_t i;
  for (i = 0; i < 3; i++)
  {
    initButton(i);
  }

  // Initialize the LCD, try using EPSON if it's not working
  s_lcd.init(PHILIPS);  
  s_lcd.contrast(BEST_CONTRAST);  // Initialize contrast
  s_lcd.clear(WHITE);  // Set background to white
}

void LCD_loop(void)
{
  //updateButtons();
}

LCDShield * LCD_Shield(void)
{
  return &s_lcd;
}
