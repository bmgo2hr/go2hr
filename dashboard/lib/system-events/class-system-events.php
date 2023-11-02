<?php
	use Go2HR\Helpers\SystemEvents;

	/**
	 * Event firing class
	 */
	Class G2hr_System_Events {
		/**
		 * Available events
		 * @var array
		 */
		public static $events = array();

		private static $_instance = null;

		public static function getInstance() {
		    if (self::$_instance == null) {
		        self::$_instance = new G2hr_System_Events();
		    }
		    return self::$_instance;
		}

		/**
		 * Trigger event method. It checks if called event is set in self::$events and then executes function by name with arguments that are passed via trigger calle
		 * @param   string     $event Event name
		 * @param   array      $args  Function arguments
		 */
		public static function trigger($event, $args = array()) {
			if(isset(self::$events[$event])) {
				call_user_func(array(new \G2hr_Events_Trigger(), self::$events[$event]), $args);
			}
		}

		/**
		 * Allow us to bind to some event using anonymous function. Example
		 *  event::bind('blog.post.create', function($args = array())
         *   {
         *      mail('myself@me.com', 'Blog Post Published', $args['name'] . ' has been published');
         *  });
		 * @param   string     $event Event name
		 * @param   Closure    $func
		 */
		public static function bind($event, Closure $func) {
			self::$events[$event][] = $func;
		}

		/**
		 * Method that allows dynamic population of events array
		 * @param   string     $event    Event name
		 * @param   string     $function Function that needs to be executed upon trigger
		 */
		public static function add($event, $function) {
			$events = self::$events;
			$events[$event] = $function;
			self::$events = $events;

			return true;
		}
	}
