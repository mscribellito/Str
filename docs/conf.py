import sys, os
from sphinx.highlighting import lexers
from pygments.lexers.web import PhpLexer

lexers['php'] = PhpLexer(startinline=True, linenos=1)
primary_domain = 'php'

extensions = []
templates_path = ['_templates']
source_suffix = '.rst'
master_doc = 'index'
project = u'Str'
copyright = u'2015, Michael Scribellito'
html_title = "Str Documentation"
html_short_title = "Str"

exclude_patterns = ['_build']
html_static_path = ['_static']
