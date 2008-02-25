<?php

class Logging
{
	function __construct($log=false, $message=false)
	{
		if ($log && $message) {
			$this->Write_to_Log($log, $message);
		}
	}

	function Check_Logs()
	{
		if (!is_dir(BASE."logs/")) {
			die("Create ".BASE."logs/");
		}
		return true;
	} // Check_logs

	function Write_to_Log($log_name, $log_message)
	{
		$this->Check_Logs();
		$filename = BASE . "logs/" . strtolower($log_name) . ".log";
		$message = $this->Format_Message($log_message);

		# Open $filename in append mode to write new content to the end of the log.
		if (!$handle = fopen($filename, 'a')) {
			echo "Cannot open file ($filename)";
			exit;
		}

		# Write the message to the end of the log
		if (fwrite($handle, $message) === FALSE) {
			echo "Cannot write to file ($filename)";
			exit;
		}
		fclose($handle);
	} // Log_error
	
	function Format_Message($message)
	{
		$timestamp = date('o-m-d H:i:s');
		$spacer = "    ";
		$message = $timestamp . $spacer . $message . "\n";
		return $message;
	} // Format_Message
	
	# Some Generic Logs
	function Error($message)
	{
		$this->Write_to_Log("Error", $message);
	} // Error
	
	function Info($message)
	{
		$this->Write_to_log("Info", $message);
	} // Info
}



?>