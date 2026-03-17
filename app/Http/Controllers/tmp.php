<? php
public function update(Request $request, $id)
    {
        $this->validate($request, [
            'srNo'        => 'required',
            'date'        => 'required',
            'staff_id'    => 'required',
            'action_done' => 'required',
        ]);

        $record = Ledger::findOrFail($id);

        // Parse existing items
        $existingItems = [];
        if (!empty($record->partsAndConsumables)) {
            $existingItems = explode(',', $record->partsAndConsumables);
            $existingItems = array_map(function ($item) {
                $parts = explode(':', $item);
                return ['name' => $parts[0], 'quantity' => $parts[1]];
            }, $existingItems);
        }

        // Process new items
        $newItems = $request->partsAndConsumables; // Assuming correct input format
        info("New Items: ". $newItems);
        
        foreach ($newItems as $newItem) {
            $found = false;
            foreach ($existingItems as &$existingItem) {
                if ($existingItem['name'] === $newItem['name']) {
                    $existingQty = (int)$existingItem['quantity'];
                    $newQty = (int)$newItem['quantity'];
                    $qtyDifference = $newQty - $existingQty;

                    // Update the corresponding product quantity
                    $product = Product::where('nama', $existingItem['name'])->first();
                    if ($product) {
                        $product->qty = max(0, $product->qty - $qtyDifference);
                        $product->save();
                    }

                    $existingItem['quantity'] = $newQty;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $existingItems[] = $newItem;
            }
        }

        // Convert the updated items array back to a comma-separated string
        $updatedItems = implode(',', array_map(function ($item) {
            return $item['name'] . ':' . $item['quantity'];
        }, $existingItems));

        // Save the updated string back to the database
        $record->partsAndConsumables = $updatedItems;
        $record->save();

        return response()->json([
            'success' => true,
            'message' => 'Items updated successfully.',
            'updated_products' => $record->partsAndConsumables,
        ]);
    }