<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;

class DatabaseLessServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Override database manager to prevent connection attempts
        $this->app->singleton('db', function ($app) {
            return new class extends DatabaseManager {
                public function __construct($app)
                {
                    // Don't call parent constructor to avoid database setup
                }
                
                public function connection($name = null)
                {
                    return new class extends Connection {
                        public function __construct()
                        {
                            // Mock connection - no actual database
                        }
                        
                        public function select($query, $bindings = [], $useReadPdo = true)
                        {
                            return [];
                        }
                        
                        public function insert($query, $bindings = [])
                        {
                            return true;
                        }
                        
                        public function update($query, $bindings = [])
                        {
                            return 1;
                        }
                        
                        public function delete($query, $bindings = [])
                        {
                            return 1;
                        }
                        
                        public function statement($query, $bindings = [])
                        {
                            return true;
                        }
                        
                        public function affectingStatement($query, $bindings = [])
                        {
                            return 1;
                        }
                        
                        public function unprepared($query)
                        {
                            return true;
                        }
                        
                        public function table($table, $as = null)
                        {
                            return new class extends Builder {
                                public function __construct()
                                {
                                    // Mock query builder
                                }
                                
                                public function get($columns = ['*'])
                                {
                                    return collect([]);
                                }
                                
                                public function first($columns = ['*'])
                                {
                                    return null;
                                }
                                
                                public function find($id, $columns = ['*'])
                                {
                                    return null;
                                }
                                
                                public function insert($values)
                                {
                                    return true;
                                }
                                
                                public function insertGetId($values, $sequence = null)
                                {
                                    return 1;
                                }
                                
                                public function update($values)
                                {
                                    return 1;
                                }
                                
                                public function delete($id = null)
                                {
                                    return 1;
                                }
                                
                                public function exists()
                                {
                                    return false;
                                }
                                
                                public function count($columns = '*')
                                {
                                    return 0;
                                }
                                
                                public function __call($method, $parameters)
                                {
                                    return $this;
                                }
                            };
                        }
                        
                        public function getSchemaBuilder()
                        {
                            return new class {
                                public function hasTable($table)
                                {
                                    return false;
                                }
                                
                                public function __call($method, $parameters)
                                {
                                    return $this;
                                }
                            };
                        }
                        
                        public function __call($method, $parameters)
                        {
                            return $this;
                        }
                    };
                }
                
                public function __call($method, $parameters)
                {
                    return $this->connection();
                }
            };
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}