Hostsharing-Ansible-CiviCRM-WordPress
=====================================

This Ansible playbook will install the latest CiviCRM release with WordPress on a server from www.hostsharing.net.

To use these modules we have to create a file named ".hsadmin.properties" in the home directory of the package admins. Into that file we have to insert the packagename and password of the package admin. 

Example:

    xyz00@h99:~$ cat .hsadmin.properties 
    xyz00.passWord=insertpkgadminpasswordhere

This file should be protected, else it would be world readable:

    xyz00@h99:~$ chmod 600 .hsadmin.properties

We clone this git-repo to our machine:

    $ git clone https://github.com/tpokorra/Hostsharing-Ansible-CiviCRM-WordPress.git

Then we change the working directory:

    $ cd Hostsharing-Ansible-CiviCRM-WordPress

All needed parameters can be set in the inventory file now. Change xyz00 to the name of your package admin. Set the name of a domain, a new user and a password. We can edit the inventory file with:

    $ cp inventory-sample.yml inventory.yml
    $ vim inventory.yml
    
The option -i can be used to read this inventory file instead of the /etc/ansible/hosts file.  We want to login with an SSH-Key. We run:

    $ ansible-playbook -i inventory.yml playbook-install.yml

If you want to hide the full CRM functionality of CiviCRM behind a proxy, and just publish some forms for the general public, you can run:

    $ ansible-playbook -i inventory.yml playbook-proxy.yml

If you want to install extension for SEPA Direct Debit, you can run:

    $ ansible-playbook -i inventory.yml playbook-sepa.yml

Now we can reach our site via:

    https://civicrm.example.org/wp-login

You need to click the button "Install CiviCRM" once.

--- Open Source Hosting ---
 https://www.hostsharing.net
