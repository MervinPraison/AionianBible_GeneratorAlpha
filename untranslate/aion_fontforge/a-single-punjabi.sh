#!/usr/bin/fontforge
#
# this worked beautifully in the resulting PDF
#
# script
Open("gentiumplus-r.ttf")
Select(700)
Copy()
Open("notosansgurmukhiui-regular.ttf")
Select(700)
Paste()
Generate("notosansgurmukhiui-regular-plus.ttf")
Open("notosansgurmukhiui-regular-plus.ttf")
Select(700)
name = GlyphInfo("Name")
class = GlyphInfo("Class")
width = GlyphInfo("Width")
color = GlyphInfo("Color")
space = " - "
Print(name, space, class, space, width, space, color)


#Open("gentiumplus-r.ttf")
#Select(65062)
#Select(700000000)
#name = GlyphInfo("Name")
#width = GlyphInfo("Width")
#color = GlyphInfo("Color")
#Print(name, width, color)
#MergeFonts("gentiumplus-r.ttf")
#Generate("newathu5_5_jeff.ttf")
