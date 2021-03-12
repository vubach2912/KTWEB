<?php

namespace App\Helpers;

class PvPGNHash
{

    private function str2blks_pvpgn($str) {
        $nblk = ((strlen($str) + 8) >> 6) + 1;
        $blks = [];
        for($i = 0; $i < $nblk * 16; $i++) {
            $blks[$i] = 0;
        }
        for($i = 0; $i < strlen($str); $i++) {
            $blks[$i >> 2] |= ord(substr($str,$i,1)) << (($i % 4) * 8);
        }
        return $blks;
    }

    private function safe_add($x,$y) {
        $lsw = ($x & 0xFFFF) + ($y & 0xFFFF);
        $msw = ($x >> 16) + ($y >> 16) + ($lsw >> 16);
        return ($msw << 16) | ($lsw & 0xFFFF);
    }

    private function safe_not($num) {
        $lsw = (~($num & 0xFFFF)) & 0xFFFF;
        $msw = (~($num >> 16)) & 0xFFFF;
        return ($msw << 16) | $lsw;
    }

    private function safe_rol($num,$amt) {
        $leftmask = 0xffff | (0xffff << 16);
        $leftmask <<= 32 - $amt;
        $rightmask = 0xffff | (0xffff << 16);
        $rightmask <<= $amt;
        $rightmask = $this->safe_not($rightmask);

        $remains = $num & $leftmask;
        $remains >>= 32 - $amt;
        $remains &= $rightmask;

        $res = ($num << $amt) | $remains;
        return $res;
    }

    private function ft($t,$b,$c,$d) {
        if($t < 20) {
            return ($b & $c) | (($this->safe_not($b)) & $d);
        }
        if($t < 40) {
            return $d ^ $c ^ $b;
        }
        if($t < 60) {
            return ($c & $b) | ($d & $c) | ($d & $b);
        }
        return $d ^ $c ^ $b;
    }

    private function kt($t) {
        if($t < 20) {
            return 0x5a82 << 16 | 0x7999;
        }
        elseif($t < 40) {
            return 0x6ed9 << 16 | 0xeba1;
        }
        elseif($t < 60) {
            return 0x8f1b << 16 | 0xbcdc;
        }
        else {
            return 0xca62 << 16 | 0xc1d6;
        }
    }

    public function get_hash($str) {
        // Fix for Unicode support by Naki-BoT
        for($i = 0;$i < strlen($str);$i++) {
            // PvPGN hash is case insensitive but only for ASCII characters
            if(ord($str[$i]) < 128) {
                $str[$i] = strtolower($str[$i]);
            }
        }

        $x = $this->str2blks_pvpgn($str);

        $a = 0x6745 << 16 | 0x2301;
        $b = 0xefcd << 16 | 0xab89;
        $c = 0x98ba << 16 | 0xdcfe;
        $d = 0x1032 << 16 | 0x5476;
        $e = 0xc3d2 << 16 | 0xe1f0;

        for($i = 0; $i < count($x); $i += 16) {
            $olda = $a;
            $oldb = $b;
            $oldc = $c;
            $oldd = $d;
            $olde = $e;

            for($j = 0; $j < 16; $j++) {
                $w[$j] = $x[$i + $j];
            }

            for($j = 0; $j < 64; $j++) {
                $ww = $w[$j] ^ $w[$j + 8] ^ $w[$j + 2] ^ $w[$j + 13];
                $w[$j + 16] = 1 << ($ww % 32);
            }

            for($j = 0; $j < 80; $j++) {
                if($j < 20) {
                    $t = $this->safe_add($this->safe_add($this->safe_rol($a,5),
                        $this->ft($j,$b,$c,$d)),$this->safe_add($this->safe_add($e,$w[$j]),$this->kt($j)));
                }
                else {
                    $t = $this->safe_add($this->safe_add($this->safe_rol($t,5),
                        $this->ft($j,$b,$c,$d)),$this->safe_add($this->safe_add($e,$w[$j]),$this->kt($j)));
                }

                $e = $d;
                $d = $c;
                $c = $this->safe_rol($b,30);
                $b = $a;
                $a = $t;
            }

            // Fix for 64-bit OS by Pada
            $a = ($this->safe_add($t,$olda) & 0xffffffff);
            $b = ($this->safe_add($b,$oldb) & 0xffffffff);
            $c = ($this->safe_add($c,$oldc) & 0xffffffff);
            $d = ($this->safe_add($d,$oldd) & 0xffffffff);
            $e = ($this->safe_add($e,$olde) & 0xffffffff);
        }
        return sprintf("%08x%08x%08x%08x%08x",$a&0xffffffff,$b&0xffffffff,$c&0xffffffff,$d&0xffffffff,$e&0xffffffff);
    }


}
