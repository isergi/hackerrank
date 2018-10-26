<?php

/*

The LeagueTable class tracks the score of each player in a league. 
After each game, the player records their score with the recordResult function. 

The player's rank in the league is calculated using the following logic:

The player with the highest score is ranked first (rank 1). The player with the lowest score is ranked last.
If two players are tied on score, then the player who has played the fewest games is ranked higher.
If two players are tied on score and number of games played, then the player who was first in the list of players is ranked higher.
Implement the playerRank function that returns the player at the given rank.

For example:

$table = new LeagueTable(array('Mike', 'Chris', 'Arnold'));
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);
echo $table->playerRank(1);
All players have the same score. However, Arnold and Chris have played fewer games than Mike, 
and as Chris is before Arnold in the list of players, he is ranked first. Therefore, the code above should display "Chris".

*/

class LeagueTable
{
	public function __construct($players)
    {
        $this->standings = array();
        $this->ranks = [];
		foreach($players as $index => $p)
        {
			$this->standings[$p] = array
            (
                'index' => $index,
                'games_played' => 0, 
                'score' => 0
            );
        }
	}
    
    public function calculatePlayersRanks($compare1, $compare2) {

        if ($compare1['score'] == $compare2['score']) {
            if ($compare1['games'] == $compare2['games']) {
                $totalRank = $compare1['index'] - $compare2['index'];
            } else {
                $totalRank = $compare1['games'] - $compare2['games'];
            }
        } else {
            $totalRank = $compare2['score'] - $compare1['score'];
        }

        return $totalRank;
    }
		
	public function recordResult($player, $score)
    {
		$this->standings[$player]['games_played']++;
		$this->standings[$player]['score'] += $score;
	}
	
	public function playerRank($rank)
    {
        $result = null;
        $this->ranks = [];
        foreach ($this->standings as $player => $playerInfo) {
            $this->ranks[] = [
                'score' => $playerInfo['score'],
                'games' => $playerInfo['games_played'],
                'index' => $playerInfo['index'],
                'name'  => $player
            ];
        }

        usort($this->ranks, array($this,'calculatePlayersRanks'));

        if (isset($this->ranks[$rank-1])) {
            $result = $this->ranks[$rank-1]['name'];
        }
        return $result;
	}
}
      
$table = new LeagueTable(array('Mike', 'Chris', 'Arnold'));
$table->recordResult('Mike', 2);
$table->recordResult('Mike', 3);
$table->recordResult('Arnold', 5);
$table->recordResult('Chris', 5);
echo $table->playerRank(1);