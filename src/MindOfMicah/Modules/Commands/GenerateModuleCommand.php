<?php
namespace MindOfMicah\Modules\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use MindOfMicah\Modules\BackboneComponentGenerator;
use MindOfMicah\Modules\ModuleGenerator;

class GenerateModuleCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'modules:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

    private $pathfinder;
    private $path_generator;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
    public function __construct(BackboneComponentGenerator $bcg, ModuleGenerator $module_generator)
	{
        parent::__construct();
        $this->backbone_componenent_generator = $bcg;
        $this->module_generator = $module_generator;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $components = $this->backbone_componenent_generator->generate($this->option('path'), $this->argument('name'));

        $this->module_generator->generate(
            $components,
            new Collection(array(
                'model'      => __DIR__ . '/../templates/model.template',
                'view'       => __DIR__ . '/../templates/view.template',
                'collection' => __DIR__ . '/../templates/collection.template',
                'index'      => __DIR__ . '/../templates/index.template',
            ))
        );

        $this->info('Successfully created 4 files');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('name', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('path', null, InputOption::VALUE_OPTIONAL, 'An example option.', public_path() . '/js/modules'),
		);
	}
}
