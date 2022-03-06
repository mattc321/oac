<?php

namespace App\Service\SyncService\Helper;

class MemberLedgerRetriever
{
    private function getledger()
    {
        $memberId = 102284;
        $psum = 0;
        $nsum = 0;
        foreach ($this->memberLedgerIterator->getEntireLedgerForMember($memberId) as $ledgerEntry) {
            if ($ledgerEntry->getTotal() < 0) {
                $nsum = $nsum + $ledgerEntry->getTotal();
                continue;
            }
            $psum = $psum + $ledgerEntry->getTotal();
        }

        $this->info("PSUM TOTAL: {$psum}");
        $this->info("NSUM TOTAL: {$nsum}");
        $this->info('NET TOTAL: ' . ($psum + $nsum));
    }
}
