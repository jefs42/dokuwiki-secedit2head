# secedit2head
[DokuWiki]: http://www.dokuwiki.org
[DokuWiki] plugin to move section edit buttons from bottom to section header

## General Info
Having the section edit button below each section added more space between sections than I wanted for my project. Some CSS of course would work, but relocating it to the same line as the section header seemed a more logical solution. Not only will it now occupy space already used for the section title,  but for long pages with long sections, it also makes it quick and easy to go to top of section (say, via ToC) and have the Edit option right there.

## Details
The plugin adds Javascript inline at the end of page content creation. It then runs two checks for (default DokuWiki config) deferred Javascript loading.
  first, that jQuery has loaded
  second, that DokuWiki's page.js has run the code that creates the section wrappers
It only then copies and removes the original edit node and **prepends** it to the h# section heading. All structure, ids, classes are kept in tact. Hover events for *section_highlight* are updated for the change in location to correctly find the parent wrapper to highlight on hover.

