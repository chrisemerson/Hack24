/*
 * Required Arduino Libraries
 */

#include <SparkFunColorLCDShield.h>

/*
 * Local Application Headers
 */

#include "lcd_controller.h"
#include "bitmaps.h"

void setup(void)
{
	Serial.begin(115200);
	LCD_setup();

	LCD_Shield()->printBMP( BMP_Get(SPARKFUN_LOGO) );
}

void loop(void)
{
	LCD_loop();
}