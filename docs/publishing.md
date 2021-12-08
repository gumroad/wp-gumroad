# Publishing a new release of the Gumroad WordPress plugin

## Prerequisites

- svn (`brew install svn`)

## Steps

1. Make the necessary changes to this Git repository and get your PR merged to the `master` branch.
 - Please make sure that the bumped up plugin version is correctly updated in the following files -
     - `gumroad/class-gumroad.php`
     - `gumroad/gumroad.php`
     - `gumroad/package.json`
     - `gumroad/README.txt`
 - Create and push the Git tag for the new version.

2. Checkout the latest copy of the plugin's remote SVN repository to a local directory.

```bash
# Here, wp-gumroad-svn is the local directory where the remote SVN repository
# will be checked out
$ svn co https://plugins.svn.wordpress.org/gumroad wp-gumroad-svn
```

3. Checkout to the latest `master` of this Git repository, and copy it to the `trunk` directory of the local SVN repository.

```bash
$ cd ~/path-to/wp-gumroad-svn
$ cp -r ~/path-to/wp-gumroad/gumroad/ trunk/
```

4. Ensure that only the expected files have been modified/added in the local SVN repository.

```diff
$ svn status
M       trunk/README.txt

$ svn diff
Index: trunk/README.txt
===================================================================
--- trunk/README.txt    (revision 2640586)
+++ trunk/README.txt    (working copy)
@@ -2,7 +2,7 @@
Contributors: karloscarweber, pderksen, nickyoung87, gumroad
Tags: gumroad, gumroad product pages, gumroad overlay, gumroad embed, ecommerce, e-commerce, pdf, javascript, overlay, embed
Requires at least: 3.9
-Tested up to: 5.7.1
+Tested up to: 5.8.2
Stable tag: 3.0.0
```

5. If the changes made to the `trunk` directory look good, copy the current `trunk` directory to the `tags` directory with an intended version.

```bash
# Copies "trunk" to a new "X.X.X" directory under "tags" directory,
# where "X.X.X" is the new plugin version, for example - 3.2.1
$ svn cp trunk tags/X.X.X
```

6. Confirm the changes using `svn status` and `svn diff`.

7. Authenticate to the remote SVN repository using the credentials found in 1Password (search for `wordpress plugin` in the `Engineering` 1Password vault).

```bash
$ svn auth
```

8. Once authenticated, commit and push the changes to the remote SVN repository.

```bash
$ svn ci -m "Adds feature ABC and bumps version to X.X.X"
```

9. The pushed changes should reflect at https://plugins.trac.wordpress.org/browser/gumroad.

10. Make sure that https://wordpress.org/plugins/gumroad/ shows the updated plugin version.
