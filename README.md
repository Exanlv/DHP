# DHP
Discord Helper PHP

This project is very much a WIP. I would not recommend using it in its current state.

Uses https://github.com/Exanlv/DHP-Core as a core

## Goal
The goal of this project is to provide an easy to use library to interact with the official discord api (websocket & REST).

## Performance
There is currently no caching for objects. Because of this, performance is not great. For now, implementing some sort of caching does not have a very high priority as it is far from production ready anyway. 

## Does this run on a standard web server?
There is nothing stopping you from running it on a web server. I will however not support it. Submitting pull requests to fix issues in web server type environments are fine as long as they do not negatively impact CLI usecases.

## For the record
PHP is not optimal for an application like a discord bot. It might be worth it to use a different language depending on your needs.