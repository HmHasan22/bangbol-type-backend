<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Qualification;
use App\Models\Score;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use Illuminate\Support\Facades\Schema;
class InsertData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:insert';

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
     * @return int
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();
        $now = now();
        $xmlString = file_get_contents('http://oddsfeed.new.188games.com/OddsFeed/188BET/hongkong/V1.0/GetOdds.aspx?language=ALL&event=ALL&market=ALL&sportsid=1&bettype=1_2,8_2');
        $xmlObject = simplexml_load_string($xmlString);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $postExistIds = array();
        try {
            foreach ($phpArray['odds']['FixtureEvent'] as $value) {
                Post::create([
                    'competition' => $value['@attributes']['competition'],
                    'competitionCht' => $value['@attributes']['competitionCht'],
                    'competitionChs' => $value['@attributes']['competitionChs'],
                    'competitionKor' => $value['@attributes']['competitionKor'],
                    'competitionVie' => $value['@attributes']['competitionVie'],
                    'hometeam' => $value['@attributes']['hometeam'],
                    'hometeamCht' => $value['@attributes']['hometeamCht'],
                    'hometeamChs' => $value['@attributes']['hometeamChs'],
                    'hometeamKor' => $value['@attributes']['hometeamKor'],
                    'hometeamVie' => $value['@attributes']['hometeamVie'],
                    'awayteam' => $value['@attributes']['awayteam'],
                    'awayteamCht' => $value['@attributes']['awayteamCht'],
                    'awayteamKor' => $value['@attributes']['awayteamKor'],
                    'awayteamChs' => $value['@attributes']['awayteamChs'],
                    'awayteamVie' => $value['@attributes']['awayteamVie'],
                    'date' => $value['@attributes']['date'],
                    'time' => $value['@attributes']['time'],
                    'title' => $value['marketline'][0]['@attributes']['title'] ?? $value['marketline']['@attributes']['title'],
                    'titlelong' => $value['marketline'][0]['@attributes']['titlelong'] ?? $value['marketline']['@attributes']['title'],
                    'section' => json_encode($value['marketline']),
                ]);
            }
            Post::where('created_at', '<', $now)->delete();
            $scores = Score::get();
            foreach($scores as $score){
                $post = Post::where('hometeam', $score->home_team)
                    ->where('awayteam', $score->away_team)
                    ->where('date', $score->match_date)
                    ->first();
               $score->update(['post_id'=>$post->id]);
                if ($post) {
                    $postExistIds[] = $post->id;
                }
            }
//            dd($postExistIds);
            Schema::disableForeignKeyConstraints();
            Score::whereNotIn('post_id', $postExistIds)->delete();
            Schema::enableForeignKeyConstraints();
//            dd($postExistIds);
//            Post::truncate();


        } catch (Exception $e) {
            // dd($e);
        }
    }
}
