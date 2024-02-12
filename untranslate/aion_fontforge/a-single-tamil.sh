#!/usr/bin/fontforge
#
# this combination did not work, glyph was way otu of place
# alternative solution is regex the source text and replace \x{02bc} with a closing smart quote or single quote
#
# script
Open("gentiumplus-r.ttf")
Select(700)
Copy()
Open("notoseriftamil-semicondensed.ttf")
Select(700)
Paste()
Generate("notoseriftamil-semicondensed-plus.ttf")
Open("notoseriftamil-semicondensed-plus.ttf")
Select(700)
name = GlyphInfo("Name")
class = GlyphInfo("Class")
width = GlyphInfo("Width")
color = GlyphInfo("Color")
space = " - "
Print(name, space, class, space, width, space, color)

Open("gentiumplus-r.ttf")
Select(700)
Copy()
Open("notoseriftamil-semicondensedbold.ttf")
Select(700)
Paste()
Generate("notoseriftamil-semicondensedbold-plus.ttf")
Open("notoseriftamil-semicondensedbold-plus.ttf")
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
