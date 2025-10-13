#!/usr/bin/env python3
"""
Transcript Simplification Script

This script processes DOVETAIL transcript files by:
1. Simplifying timestamps (keeping only starting timestamp)
2. Combining multi-line speaker segments
3. Creating clean, readable transcripts

Usage:
    python simplify_transcripts.py [input_file] [output_file]
    python simplify_transcripts.py --batch [directory]
"""

import re
import sys
import os
import argparse
from pathlib import Path


def simplify_transcript(content):
    """
    Simplify transcript by keeping only starting timestamps and combining speaker segments.
    
    Args:
        content (str): Raw transcript content
        
    Returns:
        str: Simplified transcript
    """
    lines = content.strip().split('\n')
    simplified_lines = []
    current_speaker = None
    current_text = []
    current_timestamp = None
    
    i = 0
    while i < len(lines):
        line = lines[i].strip()
        if not line:
            i += 1
            continue
            
        # Check if line is a timestamp
        timestamp_match = re.match(r'^(\d{2}:\d{2}:\d{2}\.\d{3}) --> \d{2}:\d{2}:\d{2}\.\d{3}$', line)
        if timestamp_match:
            # Look ahead for the speaker line
            if i + 1 < len(lines):
                next_line = lines[i + 1].strip()
                speaker_match = re.match(r'^<v ([^>]+)>', next_line)
                if speaker_match:
                    speaker_name = speaker_match.group(1)
                    
                    # If this is a new speaker, save previous speaker's text
                    if current_speaker and current_speaker != speaker_name and current_text:
                        combined_text = ' '.join(current_text)
                        if current_timestamp:
                            simplified_lines.append(f"[{current_timestamp}] {current_speaker}: {combined_text}")
                        else:
                            simplified_lines.append(f"{current_speaker}: {combined_text}")
                        current_text = []
                    
                    # Set current speaker and timestamp (only if new speaker)
                    if current_speaker != speaker_name:
                        current_speaker = speaker_name
                        current_timestamp = timestamp_match.group(1)
                    
                    # Remove speaker tag and get remaining text
                    remaining_text = re.sub(r'^<v [^>]+>', '', next_line).strip()
                    if remaining_text:
                        current_text.append(remaining_text)
                    
                    i += 2  # Skip both timestamp and speaker line
                    continue
        else:
            # This is continuation text for current speaker
            if current_speaker:
                current_text.append(line)
        
        i += 1
    
    # Don't forget the last speaker
    if current_speaker and current_text:
        combined_text = ' '.join(current_text)
        if current_timestamp:
            simplified_lines.append(f"[{current_timestamp}] {current_speaker}: {combined_text}")
        else:
            simplified_lines.append(f"{current_speaker}: {combined_text}")
    
    return '\n\n'.join(simplified_lines)


def process_file(input_path, output_path=None):
    """
    Process a single transcript file.
    
    Args:
        input_path (str): Path to input file
        output_path (str): Path to output file (optional)
    """
    input_path = Path(input_path)
    
    if not input_path.exists():
        print(f"Error: Input file '{input_path}' does not exist.")
        return False
    
    # Generate output path if not provided
    if output_path is None:
        output_path = input_path.parent / f"{input_path.stem} - Simplified{input_path.suffix}"
    else:
        output_path = Path(output_path)
    
    try:
        # Read input file
        with open(input_path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Simplify transcript
        simplified_content = simplify_transcript(content)
        
        # Write output file
        with open(output_path, 'w', encoding='utf-8') as f:
            f.write(simplified_content)
        
        print(f"✓ Processed: {input_path.name} -> {output_path.name}")
        return True
        
    except Exception as e:
        print(f"Error processing {input_path.name}: {e}")
        return False


def process_directory(directory_path):
    """
    Process all transcript files in a directory.
    
    Args:
        directory_path (str): Path to directory containing transcript files
    """
    directory_path = Path(directory_path)
    
    if not directory_path.exists():
        print(f"Error: Directory '{directory_path}' does not exist.")
        return
    
    # Find all transcript files (excluding already simplified ones)
    transcript_files = []
    for file_path in directory_path.glob("*.txt"):
        if not file_path.name.endswith(" - Simplified.txt"):
            transcript_files.append(file_path)
    
    if not transcript_files:
        print(f"No transcript files found in '{directory_path}'")
        return
    
    print(f"Found {len(transcript_files)} transcript files to process:")
    for file_path in transcript_files:
        print(f"  - {file_path.name}")
    
    print("\nProcessing files...")
    success_count = 0
    for file_path in transcript_files:
        if process_file(file_path):
            success_count += 1
    
    print(f"\nCompleted: {success_count}/{len(transcript_files)} files processed successfully.")


def main():
    """Main function to handle command line arguments."""
    parser = argparse.ArgumentParser(
        description="Simplify transcript files by keeping only starting timestamps and combining speaker segments",
        formatter_class=argparse.RawDescriptionHelpFormatter,
        epilog="""
Examples:
  python simplify_transcripts.py input.txt output.txt
  python simplify_transcripts.py --batch ./transcripts/
  python simplify_transcripts.py "CENTENE (Jenny-Lee).txt"
        """
    )
    
    parser.add_argument('input_file', nargs='?', help='Input transcript file')
    parser.add_argument('output_file', nargs='?', help='Output file (optional)')
    parser.add_argument('--batch', action='store_true', help='Process all files in input directory')
    
    args = parser.parse_args()
    
    if args.batch:
        if not args.input_file:
            print("Error: --batch requires a directory path")
            sys.exit(1)
        process_directory(args.input_file)
    elif args.input_file:
        process_file(args.input_file, args.output_file)
    else:
        parser.print_help()


if __name__ == "__main__":
    main()
