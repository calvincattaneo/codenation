<?php

class ChallengeTest extends TestCase
{
    public function testCreateChallenge()
    {
        
        $this->json('POST', '/challenge', [
            'numero_casas' => '8',
            'token' => '0e8201db124b8cc1ac5b6a9ee4286b2efa296144',
            'cifrado' => 'rcab lw vwb kzmibm i nqtm kittml -zn. tizzg eitt'
        ]);
        $this->seeStatusCode(200);
        $this->seeJson([
            'token' => '0e8201db124b8cc1ac5b6a9ee4286b2efa296144',
         ]);
    }

    public function testListChallenge()
    {
        $data = \App\Challenge::first();

        $this->get('challenge');
        $this->seeStatusCode(200);
        $this->seeJson([
            'token' => $data->token,
            'numero_casas' => $data->numero_casas,
            'cifrado' => $data->cifrado,
        ]);
    }

    public function testShowChallenge()
    {
        $challenge = \App\Challenge::first();
        $this->get('challenge/'.$challenge->id);
        $this->seeStatusCode(200);
        $this->seeJsonContains([
            'token' => $challenge->token,
        ]);
    }

}
