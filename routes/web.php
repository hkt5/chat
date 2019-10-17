<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/channels/{id}', 'FindChannelsController@findById');
$router->get('/channels/creator/{id}', 'FindChannelsWhenIAmCreatorController@findById');
$router->get('/invitations/{id}', 'FindInvitationsController@findById');
$router->get('/messages/{id}', 'FindMessagesController@findById');
$router->get('/moderators/{id}', 'FindModeratorsByChannelController@findById');
$router->get('/moderators/user/{id}', 'FindChannelsByModeratorController@findById');

$router->post('/channels', 'CreateChannelController@create');
$router->post('/invitations', 'CreateInvitationController@create');
$router->post('/messages', 'CreateMessageController@create');
$router->post('/moderators', 'CreateModeratorController@create');

$router->put('/channels', 'UpdateChannelController@update');
$router->put('/invitations', 'UpdateInvitationController@update');
$router->put('/messages', 'UpdateMessageController@update');
$router->put('/moderators', 'UpdateModeratorController@update');

$router->delete('/channels', 'DeleteChannelController@delete');
$router->delete('/invitations', 'DeleteInvitationController@delete');
$router->delete('/messages', 'DeleteMessageController@delete');
$router->delete('/moderators', 'DeleteModeratorController@delete');
