<?php
// 代码生成时间: 2025-09-16 05:49:27
class NetworkConnectionChecker {

    /**
     * Checks the network connection status by pinging a host.
     * 
     * @param string $host The host to ping.
     * @return bool Returns true if the connection is successful, false otherwise.
     */
    public function checkConnection($host) {
        // Check if the host is not empty
        if (empty($host)) {
            // Throw an exception if the host is empty
            throw new InvalidArgumentException('Host cannot be empty.');
        }

        // Use the exec function to ping the host
        // The -n flag is used for Windows, the -c flag is used for Unix/Linux
        $command = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? 'ping -n 1 ' . escapeshellarg($host) : 'ping -c 1 ' . escapeshellarg($host);

        // Execute the command and get the output
        $output = shell_exec($command);

        // Check if the output contains '1 received' (Windows) or '1 packets received' (Unix/Linux)
        if (preg_match('/1 received/', $output) || preg_match('/1 packets received/', $output)) {
            // Connection is successful
            return true;
        } else {
            // Connection failed
            return false;
        }
    }
}

// Example usage
try {
    $checker = new NetworkConnectionChecker();
    $host = 'www.google.com';
    $connectionStatus = $checker->checkConnection($host);
    echo 'Connection to ' . $host . ': ' . ($connectionStatus ? 'Successful' : 'Failed');
} catch (Exception $e) {
    // Handle any exceptions that occur
    echo 'Error: ' . $e->getMessage();
}