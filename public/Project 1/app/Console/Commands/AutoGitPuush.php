<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cz\Git\GitRepository;


class AutoGitPuush extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:auto-git-puush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically push changes to the Git repository every hour';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $repoPath = base_path(); // The path to your Laravel project

        try {
            $repo = new GitRepository($repoPath);
            $repo->addAllChanges();
            $commitMessage = 'Auto commit ' . now()->toDateTimeString();
            $repo->commit($commitMessage);
            $repo->push('origin', 'main'); // Adjust 'main' to your branch name if different

            $this->info('Changes have been pushed to the repository.');
        } catch (\Exception $e) {
            $this->error('Failed to push changes: ' . $e->getMessage());
        }

        return 0;
    }
}
