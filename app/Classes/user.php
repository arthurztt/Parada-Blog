<?php
class User {
    public function __construct(
        public string $username,
        public string $profileDescription,
        public int $postCount
    ) {
        $this->username = $username;
        $this->profileDescription = $profileDescription;
        $this->postCount = $postCount;
    }
}
?>