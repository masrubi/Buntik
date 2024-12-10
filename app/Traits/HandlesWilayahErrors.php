trait HandlesWilayahErrors {
    protected function handleApiError($error) {
        Log::error('Wilayah API Error', ['error' => $error]);
        return response()->json(['error' => 'Failed to fetch location data'], 500);
    }
}
