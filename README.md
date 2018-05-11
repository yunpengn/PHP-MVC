## PHP MVC

This is a minimal web MVC framework written in PHP from scratch. _It is for demonstration purpose only. It is not efficient, secured or ready for use in production._

## How to Use

- Download and install the latest version of Bitnami WAPP/MAPP/LAPP with _PHP 7.1.x_
	- Windows: [https://bitnami.com/stack/wapp/installer](https://bitnami.com/stack/wapp/installer)
	- Mac OS: [https://bitnami.com/stack/mapp/installer](https://bitnami.com/stack/mapp/installer)
	- Linux: [https://bitnami.com/stack/lapp/installer](https://bitnami.com/stack/lapp/installer)
- Download and install the latest version of [Composer](https://getcomposer.org/).
- Clone the repository to your local computer (into the `apps` folder of your WAPP/MAPP/LAPP installation).
```bash
git clone git@github.com:yunpengn/PHP-MVC.git
```
- Add the following lines to the end of `apache2/conf/bitnami/bitnami-apps-prefix.conf` (the path may be different):
```bash
Include "C:/WAPP/apps/PHP-MVC/config/httpd.conf"
```
- Go to the `config` folder under the `PHP-MVC` folder we cloned just now.
	- Create a copy (do not delete the original ones) for `config.example.php` and `httpd.example.conf` each, and rename them to `config.php` and `httpd.conf` respectively.
	- Change the values in `config.php` to fit your actual settings.
	- Change the paths in `httpd.conf` to the correct ones according to your WAPP/MAPP/LAPP installation path.
- Restart your Apache2 server.
- Open the browser and enter the URL `http://localhost/mvc` (do not use `https`). Now you should see an empty page.

## Sample Project

A simple blog system is available on the `example` branch of this repository. It supports basic user sign up/login/log out. It also supports posting blogs.

## Acknowledgments

- Tiny PHP framework [https://github.com/yuansir/tiny-php-framework]
- Peter Finder [https://github.com/yunpengn/peterfinder]

## Licence

This repository is under [GNU General Public Licence 3.0](LICENSE).

You have the freedom to distribute copies of any content within this repository, **if and only if**, under the same licence. In other words, you must make sure that these copies are also free and open source.

Also, anything provided here is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
