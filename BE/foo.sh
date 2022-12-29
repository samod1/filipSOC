#! /bin/bash

### BEGIN INIT INFO
# Provides:          foo
# Required-Start:    $local_fs $network
# Required-Stop:     $local_fs
# Default-Start:     2 3 4 5
# Default-Stop:      0 1 6
# Short-Description: foo service
# Description:       Run Foo service
### END INIT INFO

# Carry out specific functions when asked to by the system
case "$1" in
  start)
    echo "Starting Foo..."
    sudo -u foo-user bash -c 'cd /home/pi/filipSOC/BE && ./socStart.sh'
    ;;
  stop)
    echo "Stopping Foo..."
    sudo -u foo-user bash -c 'cd /path/to/scripts/ && ./stop-foo.sh'
    sleep 2
    ;;
  *)
    echo "Usage: /etc/init.d/foo {start|stop}"
    exit 1
    ;;
esac

exit 0