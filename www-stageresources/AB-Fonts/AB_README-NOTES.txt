GOALS ===============================
CURRENT
	Get back to par ASAP with no missing glyphs
	Test online only fonts for missing glyphs with speedata
ONLINE
	Google NOTO style first for standard appearance
	Unless glyph not available -OR- if font expert recommends another font
	How is the BabelStoneHan hinting? Good!
PRINT
	Compact readable style first
	Sans for latin characters
	BabelStoneHan for CJK -OR- Local font instead?  And serif for CJK?
	Or recommended alternative
	Font with TTF version required for older browsers, so no Google Noto for CJK
	See email from Andrew West of BabelStoneFont
ONLINE / PRINT FONT EXCEPTIONS
	Arabic
		notonaskharabicui-regular.ttf used for online only for NOTO consistency, BUT missing \x{28}, \x{29}, \x{2d}, \x{2b}, "()-+", so easily found with CSS secondary fonts!
		amiri-regular.ttf used for PDF for beauty and 100% glyph coverage
	Aramaic
		EstrangeloEdessa.ttf missing some latin characters, no worries online and PDF have fallback!!!
CJK
	Google Noto fonts not available in TTF but only OTF
	https://www.google.com/get/noto/help/cjk/
	And do not expect it, https://github.com/googlefonts/noto-fonts/issues/249
	All covered by BabelStoneHan except Korean
	Could possibly use OTF for CJK and not worry about TTF
	Conversion to TTF might be possible https://djmilch.wordpress.com/2016/01/19/free-font-noto-sans-cjk-in-ttf/
	But something about 'hinting' makes it no go.
Simon Cozens
	https://twitter.com/simoncozens
	Hiragino Mincho for Japanese from https://en.maisfontes.com/hiragino-mincho-pro-w3
	Kaiti for Chinese from https://fontzone.net/download/kaiti
	Nanum Myeongjo for Korean https://fonts.google.com/specimen/Nanum+Myeongjo#standard-styles
SIL
	https://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=FontDownloads
	Others to consider
	Arabic (Rubutun Kano Naskh) > https://software.sil.org/alkalami/
	Arabic (Nastaliq) > https://software.sil.org/awami/
	Arabic (warsh) > https://software.sil.org/harmattan/
	Arabic (Naskh) > https://software.sil.org/lateef/
	Arabic (Naskh) > https://software.sil.org/scheherazade/
	Myanmar > https://software.sil.org/padauk/
	Coptic > https://software.sil.org/sophianubian/
FONTFORGE
	http://wiki.unity3d.com/index.php/Create_a_new_TrueType_font_using_a_subset_of_characters_from_an_existing_TrueType_font
	Create Basic font from Liberation Sans
		Also create Liberation Sans em1000 for fonts that need that size
	Then open Noto or whatever font that is missing glyphs	
	The merge in the Basic Liberaton Sans font
	
CHECK THIS > https://en.wikipedia.org/wiki/List_of_CJK_fonts	
MING SONG ==========================
Pan-CJK
    [F] Hanazono Mincho (花園明朝)[1] Two ttf fonts HanaMinA (Japanese 花園明朝A) for BMP and HanaMinB (Japanese 花園明朝B) for SIP – covers all CJK, CJK Compatibility, CJK-Ext.A, CJK-Ext.B, CJK-Ext.C, CJK-Ext.D, CJK-Ext.E, and CJK-Ext.F. Dual licensed under its own Hanazono Font License or SIL Open Font License. This font has issues in LaTeX if rotated with \setCJKmainfont[Vertical=RotatedGlyphs]{HANAMINA.TTF}, as required for traditional writing: some characters aren't displayed after rotating, while they work without rotation.[citation needed]
    [F] Sazanami-Hanazono Mincho[2] – a full CJK and Latin-1 truetype font resulting from merge of Sazanami Mincho and Hanazono fonts.
    [F] Source Han Serif / Noto Serif CJK – created by Adobe and Google, released under SIL Open Font License v.1.1 in April 2017.[3]
    The font package TH-Tshyn consists of three fonts, TH-Tshyn-P0, TH-Tshyn-P1 and TH-Tshyn-P2. Version 2.1.0 offers complete coverage of all Unicode CJK characters up to CJK Unified Ideographs Extension F introduced in June 2017 with Unicode version 10.0.[4]
		http://cheonhyeong.com/English/download.html
Pan-Chinese
    [F] AR PL UMing (or AR PL ShanHeiSun Uni, AR PL 上海宋) – Arphic Public Licensed free font, one of CJKUnifonts project font, included with a number of Linux distributions. It is a merged version of two typefaces in Arphic PL Fonts released to free software by Arphic foundry.
Traditional Chinese
    DLCMingMedium (華康中明體), DLCMingBold (華康粗明體) – the font family from which Windows 3.0's default Traditional Chinese font 'Ming Light' is derived.
    MingLiU (細明體) – default interface typeface for Windows 3.0 to Windows XP, derived from DynaLab's DLCMing typeface. MingLiu.svg Originally distributed as a raster typeface in the Traditional Chinese version of Windows 3.0, then it was available in TrueType format as 'MingLi43' in the Traditional Chinese version of Windows 3.1. The Latin characters in this font is monospaced. Starting from version 2.00, it was internally sorted in Unicode sequence with Big-5 codepage, and carried the English name 'MingLiU'. In version 2.10, the typeface file also contained PMingLiU (新細明體), which is a proportional font. MingLiU (mingliu.ttc) was distributed with the Traditional Chinese version of Windows 95 to Windows 98, all regional versions of Windows 2000 to Windows 8.1, Traditional Chinese version of Windows 10, PMingLiU Update Pack (新細明體更新套件), Traditional Chinese Font Pack for Internet Explorer 3, Microsoft Global IME 5.02 (Traditional Chinese), Office XP Tool: Traditional Chinese Language Pack, Traditional Chinese supplemental fonts for Windows 10.
    PMingLiU (mingliu.ttc, 新細明體) – distributed by Microsoft with the Traditional Chinese version of Windows 98 operating system, all regional versions of Windows 2000 to Windows 8.1, and the Traditional Chinese version of Windows 10. The Latin characters in this font is proportional.
    MingLiU-ExtB (mingliub.ttc,細明體-ExtB), PMingLiU-ExtB (新細明體-ExtB) – distributed with PMingLiU Update Pack (新細明體更新套件), Windows Vista.
    MingLiU_HKSCS, MingLiU_HKSCS-ExtB (mingliu.ttc, mingliub.ttc) – distributed with Windows Vista.
    LiSong Pro Light (儷宋 Pro) – distributed with Mac OS 9 and Mac OS X 10.3–10.4.
    Apple LiSung Light (蘋果儷細宋) – distributed with Mac OS 9 and Mac OS X 10.2–10.4.
    [F] I.Ming (I.明體) – Derived from IPAex Minchō font, availably at Keshilu (刻石錄)[clarification needed] and GitHub.[5][6] Licensed under IPA font licence.
Simplified Chinese
    MS Song (MS宋体) – distributed with Simplified Chinese Font Pack for Internet Explorer 3, Microsoft Global IME 5.02 (Simplified Chinese), Office XP Tool: Simplified Chinese Language Pack.
    SimSun (simsun.ttc, 中易宋体 or simply 宋体) – default interface typeface for Windows 95 to Windows XP, distributed with the Chinese versions of Windows 95 to Windows 98, all regions of Windows XP, Microsoft Office 2000. The Latin characters in this font is monospaced. The difference between this font ans NSimSun (below) is that NSimSun is labelled monospaced in the post and OS/2 table while SimSun did not.[7][8]
    NSimSun (simsun.ttc, 新宋体) – distributed with all regions of Windows XP, Microsoft Office 2000. The Latin characters in this font is monospaced.
    SimSun-18030 (宋体-18030), NSimSun-18030 (新宋体-18030) – distributed with the Simplified Chinese version of Windows XP, or as GB18030 Support Package to Windows 2000 or higher.
    SimSun (Founder Extended) (宋体–方正超大字符集) – distributed with the Simplified Chinese version of Microsoft Office XP, Simplified Chinese version of Windows, or Microsoft Office Proofing Tools (XP and 2003).
    SimSun-ExtA (宋體ExtA, Sun-ExtA)
    SimSun-ExtB (simsunb.ttf, 宋體ExtB. Sun-ExtB) – distributed with Windows Vista.
    Song – distributed with OS X 10.2–10.4.
    STSong (华文宋体) – distributed with MS Office 2000 and XP, OS X 10.2–10.4. The Jiangsu-based foundry, Changzhou SinoType Technology (常州华文印刷新技术), made a series of 30,000+-character fonts for Microsoft and Macintosh between 1998 and 2004 that all begin with "ST" (华文).
    STZhongsong (华文中宋) – distributed with MS Office 2000 and XP. A medium-boldness version of STSong made in 1991 and updated in 1998.
    [F] WenQuanYi Bitmap Song (文泉驿点阵宋体) – a raster typeface under GNU GPL.
    [F][F] Fandol Song. In two weights. Licensed under GPL with the font exception. There is debate on whether the font is FOSS as the author may have revoked the license. [9]
Japanese
    [F] IPAex Minchō – Part of IPA font series developed by Information-technology Promotion Agency, Japan. Released from here.[10] Licensed under IPA font licence.
    [F] IPAmj Minchō – Part of IPA font series developed by Information-technology Promotion Agency, Japan. Released from here.[11] Licensed under IPA font licence.
    MS Mincho (ＭＳ 明朝) – distributed with the Japanese version of Windows 3.1 or later, some versions of Internet Explorer 3 Japanese Font Pack, all regions in Windows XP, Microsoft Office v.X to 2004.
    MS PMincho (ＭＳ Ｐ明朝) – distributed in the Japanese version of Windows 95 or later, all regions in Windows XP, Microsoft Office 2004.
    [F] Kochi Mincho (東風明朝) – free typeface included with a number of Linux distributions. Released in the public domain. Originally based on the Watanabe (渡邊フォント) typeface, then reissued based on the Wadalab outlines for legal reasons.
    Hiragino Minchō Pro W3 (ヒラギノ明朝Pro W3), Hiragino Minchō Pro W6 (ヒラギノ明朝Pro W6) – included in Mac OS X. It covers almost all of the Adobe Japan 1–5 glyph collection.
    Heisei Minchō (平成明朝) – developed by the Japanese Standards Association (JSA) as a standard typeface for information devices in 1989. It has rather straight edges so that low-resolution printers can output characters with less aliasing. It is distributed by various typeface vendors licensed by the JSA.
    Ryūbundō Minchō (RyūMin, リュウミン) of the Morisawa foundry.
    Kozuka Minchō (小塚明朝), designed by Kozuka Masahiko (also the creator of the sans-serif typeface Shin Gothic or Shingo).
    [F] Sazanami Mincho (さざなみ明朝).[12] The last version dates from 2004.
Korean
    Batang (바탕), BatangChe (바탕체), Gungsuh (궁서), GungsuhChe (궁서체) – distributed by Microsoft with its Windows operating system. -Che suffix means monospace font.
    AppleMyungjo (애플명조) – default Korean font on Apple Mac OS, Mac OS X, and iOS. Fully supports Unicode from Mac OS X 10.5 Leopard.
    [F] UnBatang (은바탕), UnGungsuh (은궁서) – included in most Linux distributions. Initially made by Un Koanghui (은광희) as a set of type 1 typefaces to use with Korean LaTeX. Later they were converted to opentype typefaces by Park Won-gyu (박원규). UnBatang also has a version with opentype GSUB/GPOS tables to support archaic Hangul with Hangul Conjoining Jamos.
    [F] Baekmuk Batang (백묵 바탕) – included in most Linux distributions, made by Kim Jeong-hwan (김정환) and released under a liberal license.
    Seoul Hangang (서울한강체) – distributed by Seoul Metropolitan Government as its official Ming typeface. Special font for vertical writing included.
    [F] Nanum Myeongjo (나눔명조) – one of Nanum-series fonts, distributed by Naver, under Open Font License.
    [F] Hamchorom Batang (함초롬바탕) – developed by Hancom, supporting Unicode from 1.0 to 5.0 and Hangul Jamo Extended A/B.[13]
    [F] Jieubsida Batang (지읍시다바탕) – Korean-language, Ming style offshoot of the Tsukurimashou meta-family, built using METAFONT and distributed under GPL.[14]
Vietnamese
    Nôm Na Tống Light – created by the Vietnamese Nôm Preservation Foundation. It is based on characters found in Thiền Tông Bản Hạnh (The Origin of Buddhist Meditation, 1933) by Thanh Tu Thich.[15]
    [F]Han Nom Font Set – covers Radicals Supplements, CJK, CJK Ext. A, CJK Ext. B; GPL licensed
    Han-Nom Minh 1.30 by UBPSHNVN contains 34,736 characters with 34,737 glyphs.
    Han-Nom Ming 1.10 by UBPSHNVN contains 34,079 characters with 34,082 glyphs.

	

SANS-SERIF ===============================
Pan-Unicode
    Arial Unicode MS – distributed with Microsoft Office 2000, XP, 2004.
    [F] Droid Sans Fallback – created by Ascender Corporation for use by Google's mobile operating system Android, licensed under Apache License 2.
Pan-CJK
    [F] Source Han Sans / Noto Sans CJK – created by Adobe and Google (together with Changzhou SinoType Technology, Iwata Corporation, and Sandoll Communication), released under Apache License 2 on July 15, 2014.[16][17] Since September 29, 2015, all Noto fonts are licensed under the SIL Open Font License rather than the Apache licence.[18]
Chinese
    [F] WenQuanYi Zen Hei (文泉驿正黑) – freely available and licensed under GPL v2.0 with font embedding exceptions, including over 36,000 glyphs in total, among which 20,300 are Chinese characters.
    [F] WenQuanYi Micro Hei (文泉驿微米黑) – freely available and dual licensed under GPL v3 or Apache License v2, based on Droid Sans Fallback.
    [F][F] Fandol Hei. In two weights. Licensed under GPL with the font exception. There is debate on whether the font is FOSS as the author may have revoked the license. [9]
    PingFang SC & PingFang TC & PingFang HK (苹方-简 & 蘋方-繁 & 蘋方-港) – available in OS X 10.11 El Capitan.
    Heiti SC & Heiti TC (黑体-简 & 黑體-繁) – available in OS X 10.6 Snow Leopard.
    Hiragino Sans GB (冬青黑体简体中文 & ヒラギノ角ゴ 簡体中文) – available in OS X 10.6 Snow Leopard.
    STHeiti (华文黑体) – available in OS X 10.2 Jaguar and later. Another font by Changzhou SinoType Technology made in 2002.
    STHeiti Light [STXihei] (华文细黑) – available in OS X 10.2 Jaguar and later, Microsoft Office 2000 and XP. A thinner version of STHeiti Regular.
    LiHei Pro Medium (儷黑 Pro) – available in Mac OS X 10.3 Panther and later.
    Apple LiGothic Medium (蘋果儷中黑) – available in Mac OS 9 and OS X 10.2 Jaguar and later.
    Microsoft JhengHei (msjh.ttf, msjhbd.ttf, 微軟正黑體) – distributed with Windows Vista as default interface font. Designed by China Type Design Limited.
    Microsoft YaHei (msyh.ttf,微软雅黑) – distributed with Windows Vista as default interface font. Designed by Founder Type.
    MS Hei (MS黑体) – distributed with Microsoft Global IME 5.02 (Simplified Chinese), Office XP Tool: Simplified Chinese Language Pack.
    MHei (蒙纳黑體) – Owned by Monotype.
    SimHei (simhei.ttf, 中易黑体 or simply 黑体) – distributed with Windows 2000, all regions of Windows XP.
    DengXian (等线) – distributed with Simplified Chinese version of Microsoft Office 2016 and Windows 10.
Japanese
    [F] IPA Gothic – Part of IPA font series developed by Information-technology Promotion Agency, Japan. Released from here.[19] Licensed under IPA font licence.
    Meiryo (メイリオ) – distributed with Windows Vista as default interface font.
    [F] Mona Font – a free font that is included with a number of Linux distributions. Released in the public domain.
    [F] M+ OUTLINE FONTS – Japanese font families. Released under an open-source licence.
    [F]? VL Gothic (VLゴシック) – a font originating from Vine Linux. It includes glyphs derived from M+ FONTS and Sazanami Gothic font, thus the licenses of these two fonts are both regarded.
    MS Gothic (ＭＳ ゴシック) – default system font distributed with the Japanese version of Windows 3.1 or later, all regions of Windows 2000 to Windows 8.1, Japanese version of Windows 10, Microsoft Office v.X to 2004, Japanese font pack for Internet Explorer 3, Microsoft Global IME 5.02 (Japanese), Office XP Tool: Japanese Language Pack, Japanese supplemental fonts for Windows 10.
    MS PGothic (ＭＳ Ｐゴシック) – distributed with the Japanese version of Windows 95 and later, all regions of Windows XP, Microsoft Office 2004.
    MS UI Gothic – Default interface font from Windows 98 to Windows XP. Distributed with the Japanese version of Windows 98 and later, all regions in Windows XP.
    Yu Gothic (游ゴシック) – In non-Japanese versions of Windows 10, MS Gothic is no longer included by default, so this is the default font for Japanese text.
    Osaka – default system font on Classic Mac OS.
    Hiragino Kaku Gothic (ヒラギノ角ゴ) and Hiragino Maru Gothic (ヒラギノ丸ゴ) – default Japanese system font on Mac OS X.
    Kozuka Gothic (小塚ゴシック) – typeface family provided by new versions of Adobe Illustrator.
    GothicBBB-Medium – used by Adobe as one of the two CJK fonts in many examples in its documentation.
    [F] Kochi Gothic (東風ゴシック) – Originally named Watanabe font (渡邊フォント), is a font formerly considered free that is included with a number of Linux distributions. The development of the font stopped when it was discovered that Watanabe font – which Kochi Gothic based on – was copied from the TypeBank Mincho-M font, developed by TypeBank and Design Laboratory, Hitachi, Ltd.[20][21][22]
    [F] Sazanami Gothic (さざなみゴシック)[23] – Also a font formerly considered free and included with a number of Linux distributions.[24]
Korean
    AppleGothic (애플고딕) – default Korean font on Apple Mac OS 9 to Mac OS X 10.7 Lion and iOS 1 to 5.0. Fully supports Unicode from Mac OS X 10.5 Leopard.
    Dotum (돋움), DotumChe (돋움체), Gulim (굴림) – included with the Korean version of Microsoft Windows, all regions of Windows XP to Windows 8.1, and the Korean version of Windows 10.
    GulimChe (굴림체) – Distributed with all regions of Windows 2000 to Windows 8.1, Korean version of Windows 10, Office XP Tool: Korean Language Pack, Korean supplemental fonts for Windows 10.
    Malgun Gothic (맑은 고딕) – distributed with Windows Vista as default interface font.
    New Gulim (새굴림), Gulim Old Hangul Jamo – distributed with Old Korean support tools for Microsoft Word 2000, Office XP Tool: Korean Language Pack, Microsoft Office 2003.
    Apple SD Gothic Neo (애플 SD 산돌고딕 Neo) – default Korean font on Apple Mac OS X 10.8 Mountain Lion and iOS 5.1.
    [F] UnDotum (은돋움) – one of Un-series fonts initially derived from Korean LaTeX fonts with the same name. freely available and licensed under GPL. included in a number of Linux distributions.
    [F] UnShinmun (은신문)– one of Un-series fonts initially derived from the Korean LaTeX fonts.
    [F] Baekmuk Gulim (백묵굴림) – freely available and included in a number of Linux distributions.
    Seoul Namsan (서울남산체) – distributed by Seoul Metropolitan Government as its official sans-serif typeface.
    [F] Nanum Gothic (나눔고딕) – one of Nanum-series fonts, distributed by Naver, under Open Font License.
    [F] Hamchorom Dotum (함초롬돋움) – developed by Hancom, supporting Unicode from 1.0 to 5.0 and Hangul Jamo Extended A/B.[13]
    [F] Jieubsida Dodum (지읍시다돋움) – Korean-language, sans serif offshoot of the Tsukurimashou meta-family, built using METAFONT and distributed under GPL.[14]
Vietnamese
    Han-Nom Gothic 1.30 by UBPSHNVN contains 35,733 characters with 36,306 glyphs.


	
REGULAR =======================
Chinese
    KaiU or DFKai-SB (kaiu.ttf, 標楷體) – designed by DynaComware, distributed by Microsoft with Chinese version of Windows 95 or higher. Shipped with OS X until Yosemite (disabled by default, placed in deprecated folder).
    SimKai (simkai.ttf, 中易楷体 or 楷体_GB2312) – distributed with Chinese version of Windows.
    STKaiti (华文楷体) – distributed with Simplified Chinese version of Microsoft Office. Created in 2002 by Changzhou SinoType.
    [F] AR PL UKai (AR PL 中楷) – Arphic Public Licensed free font, one of CJKUnifonts project font, included in some Linux distributions, derived from Arphic PL Fonts.
    Kai – included in Simplified Chinese version of macOS. Made by the foundry Shanghai Ikarus between 1993–95.
    BiauKai – included in Traditional Chinese version of Mac OS.
    FZKaiS-Extended and FZKaiS-Extended(SIP) for simplified Chinese as well as FZKaiT-Extended and FZKaiT-Extended(SIP) for traditional Chinese. Huge fonts with 28,928 glyphs in the basic BMP fonts plus another 54,328 in the SIP fonts for both traditional and simplified Chinese. Created in 2006 by Founder of Beijing University (北大方正). In 2012 Founder released an updated version FZNewKai (方正新楷体)[25]
    [F][F] Fandol Kai. Simplified Chinese font released under GPL with the font exception. There is debate on whether the font is FOSS as the author may have revoked the license. [9]
    [F] I.Ngaan (I.顏體), derived from a Yan styled typeface by Wang Hanzong (王漢宗), availably at Keshilu (刻石錄).[26] Licensed under GPL 2.0 and later.
    [F] TW-Kai, TW-Kai-Ext-B and TW-Kai-Plus (全字庫正楷體) – from the Ministry of Education of Taiwan (教育部).[27][28] Includes more than 100,000 traditional and simplified characters (including Japanese shinjitai characters) in Taiwanese style, covering CNS 11643 (TW-Kai covers the characters mapped to the Basic Multilingual Plane, TW-Kai-Ext-B covers the characters mapped to CJK Unified Ideographs Extension B, TW-Kai-Plus covers Private Use Area mapped CNS characters).
    [F] Free HK Kai (自由香港楷書) – designed by Free Hong Kong Font (自由香港字型) project, based on TW-Kai, and List of Glyphs of Commonly Used Characters (常用字字形表) by Education Bureau of Hong Kong SAR, licensed under CC-BY 4.0 International license.[29]
Vietnamese
    Han-Nom Kai 1.00 by UBPSHNVN contains 28,147 characters with 28,145 glyphs.

Clerical script
Chinese
    SimLi (中易隶书 or 隶书) – distributed with the Chinese version of Microsoft Office.
Korean
    [F] UnYetgul (은옛글)– one of Un-series fonts initially derived from the Korean LaTeX fonts.



	
OTHER ==========================
Pan-Unicode
    [F] GNU Unifont – a GPLed bitmap font that covers the Unicode Basic Multilingual Plane.
    Code2000
Chinese
    SimYou (幼圆) – round font style, distributed with Chinese version of Microsoft Office.
    [F][F] HanWang Series (王漢宗字体, 42 fonts) – released by Wang Hanzong (王漢宗), a professor at National Taiwan University, and licensed under GPL. Wang involved in copyright infringement with Arphic Technology for the fonts in 2005. Justfont, a CJK webfont service provider, provides 10 fonts from HanWang Series which appear safe from infringement claims.[30]
    [F][F] cwTeX Chinese fonts (5 fonts) – GPLed, includes: cwTeX 仿宋體 (Imitation Song), cwTeX 圓體 (round font), cwTeX 明體 (Ming), cwTeX 楷書 (Regular script) and cwTeX 粗黑體 (Bold Sans-serif), the Bold Sans-serif has been involved in copyright infringement with Arphic Technology.
    [F] Arphic PL Fonts (文鼎自由字型, 4 fonts) – includes AR PL KaitiM Big5 (文鼎 PL 中楷), AR PL Mingti2L Big5 (文鼎 PL 細上海宋), AR PL SungtiL GB (文鼎 PL 簡報宋) and AR PL KaitiM GB (文鼎 PL 簡中楷), released by Arphic Technology and licensed under the company's Arphic Public License. The CJKUnifonts project was derived from Arphic PL Fonts.
    AR PL MingU20-L (文鼎 PL 明體) and AR PL BaoSong2GBK (文鼎 PL 報宋), also released by Arphic Technology, but licensed under a new license which explicitly restrict distribution of the original or modified font to "only for non-profit purpose".
    [F] WenQuanYi Unibit – another bitmap monospaced font in the GPLed WenQuanYi font project.
    Series of the fonts by SinoType (Chinese: 华文; pinyin: Huá Wén; full name: 中国常州华文印刷新技术有限公司). e.g. HuaWen Xingkai (华文行楷), HuaWen CaiYun (华文彩云). Distributed with Microsoft Office.
    Series of the fonts by Founder Group (方正; Fāng Zhèng). e.g. FangZheng ShuTi (方正舒体), FangZheng QiTi (方正启体). Distributed with Microsoft Office.
    Series of the fonts by Han Yi (汉仪; Hàn Yí； full name: 北京汉仪科印信息技术有限公司). e.g. HanYi XueJun (汉仪雪君体)
    Series of the fonts by DynaLab (華康; Huá Kāng). e.g. HuaKang ShaoNu (華康少女體), HuaKang WuaWua (華康娃娃體).
    Series of the fonts by Arphic Technology (文鼎科技; Wén Dǐng Kējì).
    Shuowen Jiezi True Type Font(說文解字True Type字型) – most/all of the characters are small seal script. It is based on annotated Shuowen Jiezi and other sources.
    [F] I.PenCrane (I.鋼筆鶴體), derived from a handwriting styled typeface by Wang Hanzong (王漢宗), available at Keshilu (刻石錄).[31] Licensed under GPL 2.0 and later.
Sample of Open Huninn (Open 粉圓)
    [F] Open Huninn (Open 粉圓), rounded font style, derived from MOTOYA Kosugi Maru font. This is a free open-sourced Traditional Chinese font made by Justfont, a Taiwan font foundry.
Japanese
    Mojikyō (文字鏡)
    Y.OzFontN
    [F] Kanji Stroke Order Font (漢字の筆順のフォント)
    [F] Choumei (Kanji Stroke Order Font with the stroke numbers omitted)
Korean
    [F] UnGungseo (은궁서) – one of Un-series fonts initially derived from Korean LaTeX fonts, calligraphy styles.
    [F] Nanum Pen / Nanum Brush (나눔 손글씨) – one of Nanum-series fonts, distributed by Naver, under Open Font License.
    [F] Jieubsida Sun-Moon (지읍시다선문) – Korean-language, "felt marker style" offshoot of the Tsukurimashou meta-family, built using METAFONT and distributed under GPL.[14]