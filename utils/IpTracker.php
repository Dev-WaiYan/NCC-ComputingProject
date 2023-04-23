<?php


class IpTracker
{
    public static function recordIp()
    {
        if (!isset($_SESSION['ipRecorded'])) {
            $now = new DateTime();
            $record = array(
                'user_ip' => $_SERVER['REMOTE_ADDR'],
                'created_at' => $now->format('Y-m-d')
            );

            try {
                Db::insert('ip_tracker', $record);
            } catch (Exception $e) {
                json_encode(array('status' => 'error', 'error' => $e->getMessage()));
            }
            $_SESSION['ipRecorded'] = true;
        }
    }

    public static function getTotalViewCount()
    {
        try {
            $rows = Db::select('ip_tracker');
            return count($rows);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
