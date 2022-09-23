<?php

use App\Http\Actions\AppendUserComments;
use App\Models\User;
use Tests\TestCase;

class AppendUserCommentsTest extends TestCase
{
    public function test_can_append_comments()
    {
        $user = User::create(['name' => 'Rudolph']);
        $appendUserComments = $this->app->make(AppendUserComments::class);

        $expected = 'output';
        $comment = 'output';
        $appendUserComments->execute($user->id, $comment);
        $this->assertEquals($expected, $user->refresh()->comments);

        $expected = 'output\noutput';
        $appendUserComments->execute($user->id, $comment);
        $this->assertEquals($expected, $user->refresh()->comments);
    }
}
