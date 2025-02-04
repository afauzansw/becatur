// FileTrigger.tsx
import React, { forwardRef } from "react";
import { IconCamera, IconFolder, IconPaperclip } from "justd-icons";
import {
  FileTrigger as FileTriggerPrimitive,
  type FileTriggerProps as FileTriggerPrimitiveProps,
} from "react-aria-components";

import { Button } from "./button";

interface FileTriggerProps extends FileTriggerPrimitiveProps {
  label?: string;
  name?: string;
  errorMessage?: string;
  required?: boolean;
  className?: string;
  withIcon?: boolean;
  isDisabled?: boolean;
  intent?: "primary" | "secondary" | "danger" | "warning";
  size?: "medium" | "large" | "square-petite" | "extra-small" | "small";
  shape?: "square" | "circle";
  appearance?: "solid" | "outline" | "plain";
  accept?: string; // Specify accepted file types
  onSelect: (files: FileList | null) => void; // Callback for file selection
  selectedFiles?: File | File[] | null; // Current selected file(s)
}

const FileTrigger = forwardRef<HTMLInputElement, FileTriggerProps>(
  (
    {
      label,
      name,
      onSelect,
      errorMessage,
      required = false,
      className = "",
      intent = "primary",
      appearance = "outline",
      size = "medium",
      shape = "square",
      withIcon = true,
      accept,
      selectedFiles = null,
      ...props
    },
    ref
  ) => {
    // Determine the placeholder text based on selectedFiles and allowsMultiple
    let displayText = props.allowsMultiple ? "Browse files" : "Browse a file";

    if (selectedFiles) {
      if (props.allowsMultiple && Array.isArray(selectedFiles)) {
        displayText = `Selected ${selectedFiles.length} files`;
      } else if (!props.allowsMultiple && selectedFiles instanceof File) {
        displayText = selectedFiles.name;
      }
    }

    return (
      <div className={`file-trigger-wrapper ${className}`}>
        {label && (
          <label htmlFor={name} className="block text-sm font-medium mb-1">
            {label}
            {required && <span className="text-red-500 ml-1">*</span>}
          </label>
        )}
        <FileTriggerPrimitive {...props}>
          <Button
            isDisabled={props.isDisabled}
            intent={intent}
            size={size}
            shape={shape}
            appearance={appearance}
          >
            {withIcon &&
              (props.defaultCamera ? (
                <IconCamera />
              ) : props.acceptDirectory ? (
                <IconFolder />
              ) : (
                <IconPaperclip className="rotate-45" />
              ))}
            <span>
              {displayText} -
              {JSON.stringify(selectedFiles)}
            </span>
          </Button>
          <input
            id={name}
            name={name}
            type="file"
            required={required}
            className="ml-4 w-75"
            multiple={props.allowsMultiple}
            accept={accept}
            ref={ref} // Forward the ref to the input
            onChange={(e) => {
              const files = e.target.files;
              console.log(e.target);
              onSelect(files);
            }}

          />
        </FileTriggerPrimitive>
        {errorMessage && (
          <p className="text-red-500 text-sm mt-1">{errorMessage}</p>
        )}
      </div>
    );
  }
);

FileTrigger.displayName = "FileTrigger"; // Required for forwardRef

export { FileTrigger };
