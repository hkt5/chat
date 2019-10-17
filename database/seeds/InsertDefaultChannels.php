<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsertDefaultChannels extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1, 10) as $index) {
            DB::table('channels')->insert([
                'name' => $this->random_str(),
                'creator_id' => $index,
            ]);
        }

        foreach (range(1, 10) as $index) {
            DB::table('messages')->insert([
                'message' => $this->random_str(),
                'user_id' => $index,
                'channel_id' => $index,
            ]);

            DB::table('messages')->insert([
                'message' => $this->random_str(),
                'user_id' => $index*10,
                'channel_id' => $index*10,
            ]);
        }

        foreach (range(1, 10) as $index) {
            DB::table('invitations')->insert([
                'confirmed' => true,
                'user_id' => $index,
                'channel_id' => $index,
            ]);

            DB::table('invitations')->insert([
                'confirmed' => true,
                'user_id' => $index*10,
                'channel_id' => $index*10,
            ]);

            foreach (range(1, 10) as $index) {
                DB::table('moderators')->insert([
                    'user_id' => $index,
                    'channel_id' => $index,
                ]);
            }
        }
    }

    private function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
