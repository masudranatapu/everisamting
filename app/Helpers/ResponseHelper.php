<?php

/**
 * Response success data collection
 *
 * @param object $data
 * @param string $responseName
 * @return \Illuminate\Http\Response
 */
function responseData(?object $data, string $responseName = 'data')
{
    return response()->json([
        'success' => true,
        $responseName => $data,
    ], 200);
}

/**
 * Response success data collection
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function responseSuccess(string $msg = "Success")
{
    return response()->json([
        'success' => true,
        'message' => $msg,
    ], 200);
}

/**
 * Response error data collection
 *
 * @param string $msg
 * @param int $code
 * @return \Illuminate\Http\Response
 */
function responseError(string $msg = 'Something went wrong, please try again', int $code = 404)
{
    return response()->json([
        'success' => false,
        'message' => $msg,
    ], $code);
}

/**
 * Response success flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashSuccess(string $msg)
{
    session()->flash('success', $msg);
}

/**
 * Response error flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashError(string $message = 'Something went wrong')
{
    return session()->flash('error', $message);
}

/**
 * Response warning flash message.
 *
 * @param string $msg
 * @return \Illuminate\Http\Response
 */
function flashWarning(string $message = 'Something went wrong')
{
    return session()->flash('warning', $message);
}




/**
 * success response method.
 *
 * @return \Illuminate\Http\Response
 */
function sendResponse(int $code, string $msg, $data = null, int $status = 1, $description = ''): object
{
    return (object) array(
        'status'        => $status,
        'success'       => true,
        'code'          => $code,
        'message'       => $msg,
        'description'   => $description,
        'data'          => $data,
    );
}

/**
 * return error response.
 *
 * @return \Illuminate\Http\Response
 */
function sendError($error, $errorMessages = [], $code = 200)
{
    $response = [
        'success' => false,
        'message' => $error,
    ];

    if (!empty($errorMessages)) {
        $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
}
