<?php
/**
 * @author 		Cadillaxx
 * @copyright	© 2011 Silex Bulletin Board - Team
 * @license		GNU GENERAL PUBLIC LICENSE v3
 * @package		SilexBoard.DEV
 * @version		Revision: 1
 */

session_start();
class captcha {
    private $StringLength;
    private $FontPath;
    
    public function __construct ($ImagePath, $StringLength, $FontPath) {
        if(!file_exists($ImagePath)) {
            die('The background image does not exist.');
        }
        else if(!file_exists($FontPath)) {
            die('The font file does not exist.');
        }
        else {
            $this->StringLength = $StringLength;
            $this->FontPath = $FontPath;

            header('Content-Type: image/png');
            $this->Image = imagecreatefrompng($ImagePath);
            $this->GenerateLines();
            $this->GenerateString();
            
            imagepng($this->Image);
        }
    }

    private function GenerateLines() {
        for($i = 0; $i < 5; $i++) {
            $Color = imagecolorallocate($this->Image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
            $y = mt_rand(10, 30 * $i);
            imageline($this->Image, 0, $y, 180, $y, $Color);
            $x = mt_rand(10, 40 * $i);
            imageline($this->Image, $x, 0, $x, 80, $Color);
        }
    }
    
    private function GenerateString() {
        $StringArray = array();
        $String = '';

        for($i = 48; $i <= 57; $i++) { // 48-57 = Alle Zahlen
            $StringArray[] = chr($i);
        }
        
        for($i = 0; $i < $this->StringLength; $i++) {
            $String .= $StringArray[shuffle($StringArray)];
        }

        $CaptchaSession = '';
        for($i = 0; $i <= $this->StringLength; $i++) {
            $Color = imagecolorallocate($this->Image, mt_rand(0, 200), mt_rand(0, 200), mt_rand(0, 200));
            imagettftext($this->Image, mt_rand(30, 50), mt_rand(-25, +25), 20 + 30 * $i, mt_rand(50, 70), $Color, $this->FontPath, $String[$i]);

            $CaptchaSession .= $String[$i];
        }
        $_SESSION['Captcha'] = $CaptchaSession;
    }
}
$captcha = new captcha('../captcha/captcha.png', 5, '../captcha/ARCADE.TTF');
?>