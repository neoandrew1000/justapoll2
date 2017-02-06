<?php
/*
 * Requires database(web-poll) with a table(poll) with two fields, votes(int) and language(varchar)
 */
class Vote
{
    public $question;
    public $answers = array();
    private $_db;
    
    public function __construct($question)
    {
        //Set the question
        $this->question = $question;
 
        //Connect to the database
        try
        {
            $this->_db = new PDO('mysql:host=localhost;dbname=polls', 'root', '');
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    //Insert the users vote and update the vote count
    public function insertVote($vote)
    {
        $stmt = $this->_db->prepare("UPDATE poll SET votes = votes + 1 WHERE colour = ?");
        $stmt->execute(array($vote));
    }
 
    //Set the answers
    public function setAnswers($answer)
    {
        $this->answers[] = $answer;
    }
 
    public function displayVote()
    {
        echo '<div class="poll">
                  <p>'.$this->question.'</p>
                  <form action="customers.php" method="POST">
             ';
 
        foreach($this->answers as $answer)
        {
            echo '<p><input name="vote" type="radio" value="'.$answer.'" /> '.$answer.'</p>';
        }
 
        echo '    <input type="submit" value="Vote" />
                  </form>
              </div>
             ';
    }

    public function displayVote2()
    {
        echo '<div class="poll">
                  <p>'.$this->question.'</p>
                  <form action="creators.php" method="POST">
             ';
 
        echo '    
                  <a href="creators.php?results=show"><input type="button" value="Show results" /></a>
                  </form>
              </div>
             ';
    }
 
    private function totalVotes($answers)
    {
        //Select the votes from the database for every answer
        foreach($answers as $answer)
        {
            try
            {
                $stmt = $this->_db->prepare("SELECT votes FROM poll WHERE colour = ?");
                $stmt->execute(array($answer));
                $getvotes[] = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
 
        for($i=0; $i < count($getvotes); $i++)
        {
            $totalvotes += $getvotes[$i][votes];
        }
 
        return $totalvotes;
    }
 
    public function displayResults()
    {
        
        $totalvotes = $this->totalVotes($this->answers);
 
        $stmt = $this->_db->prepare("SELECT * FROM poll");
        $stmt->execute();
 
        echo '<div class="poll">';
 
        while($results = $stmt->fetch())
        {
            
            $percent = floor(100 / $totalvotes * $results['votes']);
 
            echo '<div class="section">
                      '.$results['colour'].': '.$percent.'% with '.$results['votes'].' votes
                      <div class="bar" style="width:'.$percent.'%;"></div>
                  </div>
                 ';
        }
 
        echo '</div>';
    }
}
 
?>