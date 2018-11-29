<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegexTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'regex:test1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $re = '/([A-Za-z]{1,12})-(\d{1,5})/m';
        $str = 'Finish release-18-05-28
bug-123
bug-800


INSIDE-125 - Vypis neprelozenych BTF
[INSIDE-13000000000000] - Intercom na loading page
[INSIDE-137] - Pod cfpor
[INSIDEeeeeeeeeeeeee-137] - blabla-123
[INSIDE-13444-12.radek bug-3333

inside-433333 - řešit
release-14.O2.2018 - řešit
bug-
3333-bug
b-Ug3
b-3
1.bug-123

bug 123
bug-31234 aaa
bug-3 222
bug-33 -222
bug-33 -fff
bU gg-234 bug-33333 21-02-bug-2018 byloAnicce-32removed wqewqug-22bug-32bug-j2222
BuG-111y
uGG-143.
INSIDE- 123
INSIDE-1234444 455

- eeeeeeeeeeAPPSUPP-54- missing
- APPSUPP-91 missing

Finish bug-44567-missing-method
- fix plugins error

iNsiDe-3 21
iNs iDe-3 21
-i-N-si-De-3 21

Finish blabla-bug-394-empty-customer
Finish blabla--empty-customer-bug-394
bug-428
bug-433

s nové soutěže Ligy národů s Ukrajinou a následný přípravný duel v Rusku. Téměř po roční odmlce se do národ bug-394ního mužstva :bug-394vracejí další středopolař Bořek Dočkal s obráncem Jakubem Brabcem a ješt

castka-16400-ktera bude strzena
dne-18-05-2018
';

        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);

        /*foreach ($matches as $match){
            //var_dump($match);
            var_dump($match[0]);
            $jiraKey=($match[0]);
        }*/

        /*foreach ($matches as $match){
            $jiraKey = $match[0];
            var_dump($jiraKey);
        }*/
        foreach ($matches as $match){
            foreach ($match as $jiraKey)
                //echo $jiraKey; <- vypíše jako jednolitý string, bez mezer apod.
                var_dump($jiraKey); // <- vypíše jednotlivé položky (skupiny), zbytečný 2x foreach
            }
        }

// Print the entire match result
//dd($matches);


}
