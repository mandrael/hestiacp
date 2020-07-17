#!/bin/bash

hestia_module_web_setup-ips() {
    source $HESTIA/bin/module/func.inc

    if [ "$OS_BASE" = 'debian' ]; then
        remoteip_conf=$OSAL_PATH_APACHE_MODS_AVAILABLE/remoteip.conf
    else
        remoteip_conf=$OSAL_PATH_APACHE_CONF_D/remoteip.conf
    fi

    # Get main IP
    local_ip=$(ip addr|grep 'inet '|grep global|head -n1|awk '{print $2}'|cut -f1 -d/)
    pub_ip=$(curl --ipv4 -s https://ip.hestiacp.com/)

    echo "Configuring web IP addresses (local: $local_ip, public: $pub_ip)"

    # FIXME: the following line should be: if WEB_SYSTEM is apache and PROXY_SYSTEM is something (i.e. not [ null or 'no' ])
    if ( [ "$WEB_SYSTEM" = 'apache2' ] || [ "$WEB_SYSTEM" = 'httpd' ] ) && [ "$PROXY_SYSTEM" = 'nginx' ]; then
        echo "Configuring remoteip apache module"
        # If we are using web server and proxy server, configure mod_remoteip
        echo "<IfModule mod_remoteip.c>" > $remoteip_conf
        echo "  RemoteIPHeader X-Real-IP" >> $remoteip_conf
        if [ "$local_ip" != "127.0.0.1" ] && [ "$pub_ip" != "127.0.0.1" ]; then
            echo "  RemoteIPInternalProxy 127.0.0.1" >> $remoteip_conf
        fi
        if [ ! -z "$local_ip" ] && [ "$local_ip" != "$pub_ip" ]; then
            echo "  RemoteIPInternalProxy $local_ip" >> $remoteip_conf
        fi
        if [ ! -z "$pub_ip" ]; then
            echo "  RemoteIPInternalProxy $pub_ip" >> $remoteip_conf
        fi
        echo "</IfModule>" >> $remoteip_conf

        sed -i "s/LogFormat \"%h/LogFormat \"%a/g" $OSAL_PATH_APACHE_CONF/${OSAL_PKG_APACHE}.conf
    else
        # Unconfigure remoteip
        [ -f $remoteip_conf ] && rm $remoteip_conf
        sed -i "s/LogFormat \"%a/LogFormat \"%h/g" $OSAL_PATH_APACHE_CONF/${OSAL_PKG_APACHE}.conf
    fi

    if [ "$OS_BASE" = 'debian' ]; then
        osal_apache_module_enable remoteip
    fi
    
    for ip_conf in $HESTIA/data/ips/*; do
        ip=$(basename $ip_conf)
        $BIN/hestia module web setup-ip --ip "$ip"
    done
}