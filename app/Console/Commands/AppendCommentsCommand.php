<?php

namespace App\Console\Commands;

use App\Http\Actions\AppendUserComments;
use Illuminate\Console\Command;

class AppendCommentsCommand extends Command
{
    protected $signature = 'append:comments
                            {id : The User ID.}
                            {comments* : Comments to be appended. Can input as many as you want.}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(AppendUserComments $appendUserComments)
    {
        $id = $this->argument('id');
        $comments = implode(' ', $this->argument('comments'));

        // strictly check if id is integer
        if (!(is_numeric($id) && floor($id) === floatval($id))) {
            $this->error('Invalid id');
            return 1;
        }

        try {
            $appendUserComments->execute($id, $comments);
        } catch (\Exception $e) {
            $this->error('Could not update database: '.$e->getMessage());
            return 1;
        }

        $this->info("Appended comment $comments to User $id");
        return 0;
    }
}
