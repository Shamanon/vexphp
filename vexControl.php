<?php
/* SVN FILE: $Id$ */
/*
 *
 * Project Name : vexphp
 *
 * $Copyright$
 *
 * $License$
 *
 * @package vexControl
 * @author $Author$
 * @version $Revision$
 * @lastrevision $Date$
 * @modifiedby $LastChangedBy$
 * @lastmodified $LastChangedDate$
 * @filesource $URL$
 *
 */
 
 class vexControl 
 {
 
 	public $port = '/dev/ttyS0';
 	
 	 // set port to paramaters that make VEX happy
 	function port_ready()
 	{
 	
 		return `stty -F /dev/ttyS0 115200 -parenb -parodd cs8 -hupcl -cstopb cread clocal -crtscts \
		ignbrk -brkint -ignpar -parmrk -inpck -istrip -inlcr -igncr -icrnl -ixon -ixoff -iuclc -ixany -imaxbel -iutf8 \
		-opost -olcuc -ocrnl -onlcr -onocr -onlret -ofill -ofdel nl0 cr0 tab0 bs0 vt0 ff0 \
		-isig -icanon -iexten -echo -echoe -echok -echonl -noflsh -xcase -tostop -echoprt -echoctl -echoke \
		min 1 time 5`;
 	
 	}
 	
 	// get info from port using stty
 	function port_info()
 	{
 	
 		return `stty -a <$this->port`;
 	
 	}
 	
 	// read data from the port
 	function port_read()
 	{
		

 		$handle = fopen($this->port, 'r');

		if ($handle !== false){
			
			$content = fread($handle, 54);

			fclose($handle);
			
			return $content;
			
		}

 	
 	}
 	
 	// send packet to initiate broadcast
 	function controller_init()
 	{
 		
 		exec('echo -e "\xc9\x17\x01\x00\x00\x00" > '.$this->port);
 		
 	}
 	
 	// send packet to stop broadcast
 	function controller_exit()
 	{
 		
 		exec('echo -e "\xc9\x17\x02\x00\x00\x00" > '.$this->port);
 		
 	}
 	
 	// reset controller parts to base/stopped states
 	function controller_reset($action='broadcast')
 	{
 		
 		
 			if($action == 'motors' || $action == 'all')
 				for($i = 0; $i < 8; $i++)
 					exec('echo -e "\xc9\x17\x04\x0'.$i.'\x7f\x00" > '.$this->port);
 				
 			if($action == 'digital' || $action == 'all')
 				for($i = 0; $i < 8; $i++){
 					exec('echo -e "\xc9\x17\x06\x0'.$i.'\x00\x00" > '.$this->port);
 		
 			if($action == 'broadcast' || $action == 'all')
 				exec('echo -e "\xc9\x17\x03\x00\x00\x00" > '.$this->port);
 		
 		}
 		
 	}
 	
 	// set motor position
 	function controller_motor($motor,$value=127)
 	{
 	
 		$value = dechex($value);
 		exec('echo -e "\xc9\x17\x04\x0'.$motor.'\x'.$value.'\x00" > '.$this->port);
 		
 	}
 	
 	// set digital output
 	function controller_digital($output,$value=0)
 	{
 	
 		exec('echo -e "\xc9\x17\x06\x0'.$output.'\x0'.$value.'\x00" > '.$this->port);
 		
 	}

	// toys 	
 	function flash_eye()
	{
	
		for($i = 0; $i < 10 ; $i++){
			echo $this->controller_digital(0,1);
			usleep(300);
			echo $this->controller_digital(0,0);
			usleep(300);
		}
	
	}
	
	function nod_head()
	{
		for($i = 127; $i < 200; $i = $i + 30){
			$this->controller_motor(0,$i);
			usleep(100);
		}
		for($i = 200; $i > 55; $i = $i - 30){ 
			$this->controller_motor(0,$i);
			usleep(100);
		}
		for($i = 55; $i < 230; $i = $i + 30){ 
			$this->controller_motor(0,$i);
			usleep(100);
		}
		usleep(10);
		$this->controller_motor(0,127);
		$this->controller_motor(0,127);
	}
	
	function shake_head()
	{
		for($i = 127; $i < 255; $i = $i + 10){
			$this->controller_motor(1,$i);
		}
		for($i = 200; $i > 0; $i = $i - 10){ 
			$this->controller_motor(1,$i);
			usleep(100);
		}
		for($i = 0; $i < 255; $i = $i + 10){ 
			$this->controller_motor(1,$i);
		}
		usleep(10);
		$this->controller_motor(1,127);
		$this->controller_motor(1,127);
	}

}
 ?>