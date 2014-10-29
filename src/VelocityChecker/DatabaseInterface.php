<?php

namespace Kata\VelocityChecker;


interface DatabaseInterface
{
    function connect();

    function prepare($statement);

    function exec($statement);

}