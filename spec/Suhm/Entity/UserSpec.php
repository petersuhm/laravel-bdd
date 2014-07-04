<?php

namespace spec\Suhm\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Suhm\Entity\User');
        $this->shouldImplement('Illuminate\Auth\UserInterface');
    }

    function it_constructs_user_from_input()
    {
        $input = ['email' => 'foo@example.com', 'password' => 'secret'];

        $this->beConstructedWith($input);

        $this->email->shouldBe('foo@example.com');
        $this->password->shouldBe('secret');
    }
}
