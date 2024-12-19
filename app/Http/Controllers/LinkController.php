<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\LinkTheme;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function linkstrees(string $urlx)
    {
        $linkx = Link::where('url_slug', $urlx)->first();
        $variable = LinkTheme::find($linkx->theme_id);
        $colorList = [
            'slate' => ['rgb(226 232 240);', 'rgb(100 116 139);', 'rgb(30 41 59);', 'rgb(15 23 42);',],
            'gray' => ['rgb(229 231 235);', 'rgb(107 114 128);', 'rgb(31 41 55);', 'rgb(17 24 39);',],
            'zinc' => ['rgb(228 228 231);', 'rgb(113 113 122);', 'rgb(39 39 42);', 'rgb(24 24 27);',],
            'neutral' => ['rgb(229 229 229);', 'rgb(115 115 115);', 'rgb(38 38 38);', 'rgb(23 23 23);',],
            'stone' => ['rgb(231 229 228);', 'rgb(120 113 108);', 'rgb(41 37 36);', 'rgb(28 25 23);',],
            'red' => ['rgb(254 202 202);', 'rgb(239 68 68);', 'rgb(153 27 27);', 'rgb(127 29 29);',],
            'orange' => ['rgb(254 215 170);', 'rgb(249 115 22);', 'rgb(154 52 18);', 'rgb(124 45 18);',],
            'amber' => ['rgb(253 230 138);', 'rgb(245 158 11);', 'rgb(146 64 14);', 'rgb(120 53 15);',],
            'yellow' => ['rgb(254 240 138);', 'rgb(234 179 8);', 'rgb(133 77 14);', 'rgb(113 63 18);',],
            'lime' => ['rgb(217 249 157);', 'rgb(132 204 22);', 'rgb(63 98 18);', 'rgb(54 83 20);',],
            'green' => ['rgb(187 247 208);', 'rgb(34 197 94);', 'rgb(22 101 52);', 'rgb(20 83 45);',],
            'emerald' => ['rgb(167 243 208);', 'rgb(16 185 129);', 'rgb(6 95 70);', 'rgb(6 78 59);',],
            'teal' => ['rgb(153 246 228);', 'rgb(20 184 166);', 'rgb(17 94 89);', 'rgb(19 78 74);',],
            'cyan' => ['rgb(165 243 252);', 'rgb(6 182 212);', 'rgb(21 94 117);', 'rgb(22 78 99);',],
            'sky' => ['rgb(186 230 253);', 'rgb(14 165 233);', 'rgb(7 89 133);', 'rgb(12 74 110);',],
            'blue' => ['rgb(191 219 254);', 'rgb(59 130 246);', 'rgb(30 64 175);', 'rgb(30 58 138);',],
            'indigo' => ['rgb(199 210 254);', 'rgb(99 102 241);', 'rgb(55 48 163);', 'rgb(49 46 129);',],
            'violet' => ['rgb(221 214 254);', 'rgb(139 92 246);', 'rgb(91 33 182);', 'rgb(76 29 149);',],
            'purple' => ['rgb(233 213 255);', 'rgb(168 85 247);', 'rgb(107 33 168);', 'rgb(88 28 135);',],
            'fuchsia' => ['rgb(245 208 254);', 'rgb(217 70 239);', 'rgb(134 25 143);', 'rgb(112 26 117);',],
            'pink' => ['rgb(251 207 232);', 'rgb(236 72 153);', 'rgb(157 23 77);', 'rgb(131 24 67);',],
            'rose' => ['rgb(254 205 211);', 'rgb(244 63 94);', 'rgb(159 18 57);', 'rgb(136 19 55);',],
        ];

        return view('tree', [
            'linkx' => $linkx,
            'variable' => $colorList[$variable->variables],
        ]);
    }
}
