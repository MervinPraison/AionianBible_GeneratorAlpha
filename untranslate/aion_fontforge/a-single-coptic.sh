#!/usr/bin/fontforge
#
# this combination did not work, glyph was way otu of place, \x{fe26}
# only 10 of them so ignoring for now
#
# script
Open("symbola-ajyx.ttf")
Select(65062)
Copy()
Open("newathu5_5.ttf")
Select(65062)
Paste()
Generate("newathu5_5_plus.ttf")
Open("newathu5_5_plus.ttf")
Select(65062)
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
