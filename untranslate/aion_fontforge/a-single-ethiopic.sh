#!/usr/bin/fontforge
#
# this worked beautifully in the resulting PDF
#
# script
#  \x{13b9}\x{13ba} 
Open("donisiladv.ttf")
Select(5049)
Copy()
Open("abyssinicaSIL-regular.ttf")
Select(5049)
Paste()
Open("donisiladv.ttf")
Select(5050)
Copy()
Open("abyssinicaSIL-regular.ttf")
Select(5050)
Paste()
Generate("abyssinicaSIL-regular-plus.ttf")

#Open("gentiumplus-r.ttf")
#Select(65062)
#Select(700000000)
#name = GlyphInfo("Name")
#width = GlyphInfo("Width")
#color = GlyphInfo("Color")
#Print(name, width, color)
#MergeFonts("gentiumplus-r.ttf")
#Generate("newathu5_5_jeff.ttf")
