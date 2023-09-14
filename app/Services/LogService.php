<?php

namespace App\Services;

use App\Models\AuditLog;

class LogService
{
    private $logData;

    public function setLogData($data) {
        $this->logData = $data;
    }

    public function insertLogData() {
        $auditlog = new AuditLog();
        foreach ($this->logData as $key => $val) {
            $auditlog->{$key} = $val;
        }
        $auditlog->save();
    }
}
