#!/bin/bash

##
# Description:     To work correctly, you have to execute this script when you're in the root of the project in your terminal
#                  (e.g., you@you:/path/to/root-project$ bash _tools/pH7.sh).
#
# URL:             http://github.com/pH7Software/pH7-Social-Dating-CMS/blob/master/_tools/pH7.sh
# Software URL:    http://ph7cms.com
#
# Author:          Pierre-Henry Soria <ph7software@gmail.com>
# Copyright:       (c) 2012-2016, Pierre-Henry Soria. All Rights Reserved.
# License:         GNU General Public License 3 or later <http://www.gnu.org/licenses/gpl.html>
##

accepted_ext="-name '*.php' -or -name '*.css' -or -name '*.js' -or -name '*.html' -or -name '*.xml' -or -name '*.xsl' -or -name '*.xslt' -or -name '*.json' -or -name '*.yml' -or -name '*.tpl' -or -name '*.phs' -or -name '*.ph7' -or -name '*.sh' -or -name '*.sql' -or -name '*.ini' -or -name '*.md' -or -name '*.markdown' -or -name '.htaccess'"
exec="find . -type f \( $accepted_ext \) -print0 | xargs -0 perl -wi -pe"
eval "$exec 's/\s+$/\n/'"
 eval "$exec 's/\t/    /g'"

echo "The code has been cleaned!"