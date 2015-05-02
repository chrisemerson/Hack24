#ifndef _LCD_CONTROLLER_H_
#define _LCD_CONTROLLER_H_

void LCD_setup(void);
void LCD_loop(void);

LCDShield * LCD_Shield(void);

void LCD_ResetBitmap(void);
void LCD_SetNextBitmapPixel(uint16_t colour);
bool LCD_BitmapComplete(void);

#endif