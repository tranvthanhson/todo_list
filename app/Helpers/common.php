<?php


if (!function_exists('dd')) {
    /**
     * Dd
     *
     * @param mixed $param param
     *
     * @return void
     */
    function dd($param)
    {
        die(var_dump($param));
    }
}

if (!function_exists('view')) {
    /**
     * Require a view.
     *
     * @param string $name name
     * @param array  $data data
     *
     * @return mixed
     */
    function view($name, $data = [])
    {
        extract($data);

        return require "app/views/{$name}.view.php";
    }
}
if (!function_exists('redirect')) {
    /**
     * Redirect to a new page.
     *
     * @param string $path path
     *
     * @return void
     */
    function redirect($path)
    {
        header("Location: /{$path}");
    }
}
