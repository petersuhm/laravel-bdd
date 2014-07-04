<?php

namespace spec\Suhm\Storage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Illuminate\Hashing\HasherInterface as Hasher;
use Suhm\Entity\User;

class ArrayUserRepositorySpec extends ObjectBehavior
{
    function let(Hasher $hasher)
    {
        $this->beConstructedWith($hasher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Suhm\Storage\ArrayUserRepository');
        $this->shouldImplement('Suhm\Storage\UserRepository');
        $this->shouldImplement('Illuminate\Auth\UserProviderInterface');
    }

    function it_creates_a_new_instance()
    {
        $this->newInstance()->shouldBeAnInstanceOf('Suhm\Entity\User');
    }

    function it_persists_a_user_instance(User $user)
    {
        $this->persist($user);

        $this->allUsers()->shouldContain($user);
    }

    function it_retrieves_a_user_from_identifier(User $user)
    {
        $id = 10;

        $this->retrieveById($id)->shouldReturn(null);

        $user->id = 10;
        $this->persist($user);

        $this->retrieveById($id)->shouldReturn($user);
    }

    function it_retrieves_a_user_from_credentials(User $user)
    {
        $credentials['email'] = 'foo@example.com';

        $this->retrieveByCredentials($credentials)->shouldReturn(null);

        $user->email = 'foo@example.com';
        $this->persist($user);

        $this->retrieveByCredentials($credentials)->shouldReturn($user);
    }

    function it_validates_a_user_against_credentials(Hasher $hasher, User $user)
    {
        $hasher->check('secret', 'secret')->willReturn(true);
        $this->beConstructedWith($hasher);

        $credentials = ['email' => 'foo@example.com', 'password' => 'secret'];
        $user->email = 'foo@example.com';
        $user->getAuthPassword()->willReturn('secret');

        $this->validateCredentials($user, $credentials)->shouldReturn(true);

        $credentials['email'] = 'bar@example.com';

        $this->validateCredentials($user, $credentials)->shouldReturn(false);

    }
}
