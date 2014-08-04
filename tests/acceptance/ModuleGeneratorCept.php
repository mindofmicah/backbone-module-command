<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Generate the full structure of a new module for Backbone / RequireJS');

// Make sure that we're dealing with a clean directory
$I->cleanDir('tests/tmp');

$I->runShellCommand('php ../../../artisan modules:generate taco --path=tests/tmp/modules');
$I->seeInShellOutput('Successfully created 4 files');

$I->openFile('tests/tmp/modules/tacos/models/taco.js');
$I->seeFileContentsEqual(file_get_Contents('tests/acceptance/stubs/model.stub'));
$I->openFile('tests/tmp/modules/tacos/collections/tacos.js');
$I->seeFileContentsEqual(file_get_Contents('tests/acceptance/stubs/collection.stub'));
$I->openFile('tests/tmp/modules/tacos/views/taco_view.js');
$I->seeFileContentsEqual(file_get_Contents('tests/acceptance/stubs/view.stub'));
$I->openFile('tests/tmp/modules/tacos/index.js');
$I->seeFileContentsEqual(file_get_Contents('tests/acceptance/stubs/index.stub'));


$I->cleanDir('tests/tmp');
