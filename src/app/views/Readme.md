## MVA - Minimum Viable Application
 _For PHP using composer initiated AutoLoad (PSR-4)_

Intended to demonstrate the building an appication ...

### Pradigm

PHP is a scripting language which produces a result, usually styled by html and css.

It excecutes and terminates - it doesn't wait around for user input ... unlike a desktop application.

So.. in a few seconds, A PHP Application will ..
* set up an environment
* identify a task
* terminate.

Servers - such as Apache, execute a single PHP thread, executing many PHP threads simultaeously and in rapid succession.

#### The Application structure
* has a single entry point
* breaks down the *```_REQUEST_URI_```* and accepts *```_POST```* into parameters
* and will drive the program through routes to achieve the desired result

<table class="table">
    <thead class="small font-weight-bold">
        <tr>
            <td>url</td>
            <td>controller</td>
            <td>function</td>
            <td>... parameters ...</td>
        </tr>
    <thead>
    <tbody>
        <tr>
            <td>http://example.dom /</td>
            <td>people /</td>
            <td>view /</td>
            <td>254</td>
        </tr>
        <tr>
            <td><strong>Application</strong> ></td>
            <td>calls <strong>Controller</strong> ></td>
            <td colspan="2">compiles <strong>Result</strong></td>
        </tr>
    </tbody>
</table>

### Features

<table class="table">
    <thead class="small font-weight-bold">
        <tr>
            <td>Feature</td>
            <td>File(s)</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Model View Conroller</td>
            <td>app/controller/hello</td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-bold pb-0">Data Access</td>
        </tr>
        <tr>
            <td class="pl-3">Data Access Objects (DAO)</td>
            <td>app/dao/todo</td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-bold pl-3 pb-0">Dynamic Maintenance</td>
        </tr>
        <tr>
            <td class="pl-3">version checking</td>
            <td>app/controller/hello</td>
        </tr>
        <tr>
            <td class="pl-3">execution</td>
            <td>app/dao/dbinfo</td>
        </tr>
        <tr>
            <td class="pl-3">definition of data structures</td>
            <td>app/dao/db/todo</td>
        </tr>
        <tr>
            <td>access data through REST API</td>
            <td>app/controller/hello</td>
        </tr>
        <tr>
            <td>AJAX</td>
            <td>
                app/views/todo<br />
                app/controller/hello
            </td>
        </tr>
    </tbody>
</table>
